<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code PDF Editor</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .pdf-page {
            position: relative;
            border: 2px solid #e5e7eb;
            margin: 10px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .qr-overlay {
            position: absolute;
            cursor: move;
            border: 2px dashed #3b82f6;
            background: rgba(59, 130, 246, 0.1);
            user-select: none;
            z-index: 10;
        }

        .qr-overlay:hover {
            border-color: #1d4ed8;
            background: rgba(29, 78, 216, 0.2);
        }

        .qr-overlay.dragging {
            opacity: 0.7;
            transform: scale(1.05);
        }

        .resize-handle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #3b82f6;
            border: 1px solid white;
            border-radius: 50%;
        }

        .resize-handle.nw {
            top: -5px;
            left: -5px;
            cursor: nw-resize;
        }

        .resize-handle.ne {
            top: -5px;
            right: -5px;
            cursor: ne-resize;
        }

        .resize-handle.sw {
            bottom: -5px;
            left: -5px;
            cursor: sw-resize;
        }

        .resize-handle.se {
            bottom: -5px;
            right: -5px;
            cursor: se-resize;
        }

        .drop-zone-active {
            border-color: #10b981 !important;
            background-color: rgba(16, 185, 129, 0.1) !important;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-600 via-blue-600 to-cyan-600 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-cyan-600 bg-clip-text text-transparent mb-4">
                    QR Code PDF Editor Pro
                </h1>
                <p class="text-gray-600 text-lg">Upload PDF, generate/upload QR codes, and drag them wherever you want!
                </p>
            </div>

            <!-- QR Code Bank -->
            <div id="qrBank"
                class="mb-8 p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl border border-gray-200 min-h-24">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    QR Code Collection - Drag onto PDF pages
                </h3>
                <div id="qrList" class="flex flex-wrap gap-4">
                    <div class="text-gray-500 italic text-center w-full py-8">
                        Generate or upload QR codes to get started
                    </div>
                </div>
            </div>

            <!-- PDF Viewer -->
            <div id="pdfViewer" class="bg-gray-50 rounded-2xl p-6 min-h-96">
                <div class="text-center text-gray-500 py-20">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                    </svg>
                    <p class="text-xl font-medium">Upload a PDF file to start editing</p>
                    <p class="text-sm text-gray-400 mt-2">Supported formats: PDF</p>
                </div>
            </div>

            <!-- Status -->
            <div id="status" class="mt-6 text-center text-gray-600"></div>
            <button id="submitPdf" class="mt-4 bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 transition-colors">Submit PDF</button>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

    <script>
        class QRPDFEditor {
            constructor() {
                this.pdfDoc = null;
                this.originalPdfBytes = null;
                this.pages = [];
                this.qrCodes = [];
                this.draggedQR = null;
                this.selectedQROverlay = null;
                this.isResizing = false;
                this.resizeHandle = null;

                this.init();
            }

            init() {
                // Set PDF.js worker
                pdfjsLib.GlobalWorkerOptions.workerSrc =
                    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

                this.setupEventListeners();
                this.handlePdfUpload();
                this.generateQRCode();
            }

            setupEventListeners() {
                // // Download
                // document.getElementById('downloadPdf').addEventListener('click', () => this.downloadPDF());
                document.getElementById('submitPdf').addEventListener('click', () => this.submitPDF());

                // Global mouse events for dragging
                document.addEventListener('mousemove', (e) => this.handleGlobalMouseMove(e));
                document.addEventListener('mouseup', () => this.handleGlobalMouseUp());
            }

            async handlePdfUpload() {
                this.updateStatus('Loading PDF...');

                try {
                    const pdfUrl = "{{ $fileUrl }}";
                    const existingPdfBytes = await fetch(pdfUrl).then(res => res.arrayBuffer());
                    this.originalPdfBytes = existingPdfBytes;

                    // Load with PDF.js for viewing
                    const loadingTask = pdfjsLib.getDocument(pdfUrl);
                    this.pdfDoc = await loadingTask.promise;

                    await this.renderAllPages();
                    this.updateStatus(`PDF loaded successfully! ${this.pdfDoc.numPages} pages`);

                } catch (error) {
                    console.error('Error loading PDF:', error);
                    this.updateStatus('Error loading PDF');
                }
            }

            async renderAllPages() {
                const viewer = document.getElementById('pdfViewer');
                viewer.innerHTML = '';
                this.pages = [];

                for (let pageNum = 1; pageNum <= this.pdfDoc.numPages; pageNum++) {
                    const page = await this.pdfDoc.getPage(pageNum);
                    const viewport = page.getViewport({
                        scale: 1.2
                    });

                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const pageContainer = document.createElement('div');
                    pageContainer.className = 'pdf-page relative inline-block';
                    pageContainer.style.width = viewport.width + 'px';
                    pageContainer.style.height = viewport.height + 'px';
                    pageContainer.appendChild(canvas);

                    // Add drop zone functionality
                    this.setupDropZone(pageContainer, pageNum - 1);

                    viewer.appendChild(pageContainer);

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    await page.render(renderContext).promise;

                    this.pages.push({
                        canvas: canvas,
                        container: pageContainer,
                        viewport: viewport,
                        qrOverlays: []
                    });
                }
            }

            setupDropZone(container, pageIndex) {
                container.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    container.classList.add('drop-zone-active');
                });

                container.addEventListener('dragleave', (e) => {
                    if (!container.contains(e.relatedTarget)) {
                        container.classList.remove('drop-zone-active');
                    }
                });

                container.addEventListener('drop', (e) => {
                    e.preventDefault();
                    container.classList.remove('drop-zone-active');

                    if (this.draggedQR) {
                        const rect = container.getBoundingClientRect();
                        const x = e.clientX - rect.left - 50; // Center the QR code
                        const y = e.clientY - rect.top - 50;

                        this.addQRToPage(pageIndex, this.draggedQR, x, y);
                        this.draggedQR = null;
                    }
                });
            }

            generateQRCode() {
                const text = "TEST QR CODE";

                const canvas = document.createElement('canvas');
                QRCode.toCanvas(canvas, text, {
                    width: 200,
                    margin: 1,
                    color: {
                        dark: '#000000',
                        light: '#FFFFFF'
                    }
                }, (error) => {
                    if (error) {
                        console.error(error);
                        this.updateStatus('Error generating QR code');
                        return;
                    }

                    this.addQRToBank(canvas.toDataURL(), text);
                });
            }

            handleQRUpload(event) {
                const file = event.target.files[0];
                if (!file || !file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.addQRToBank(e.target.result, 'Uploaded QR');
                    this.updateStatus('QR code uploaded successfully!');
                };
                reader.readAsDataURL(file);
            }

            addQRToBank(imageSrc, label) {
                const qrItem = {
                    id: Date.now() + Math.random(),
                    src: imageSrc,
                    label: label
                };

                this.qrCodes.push(qrItem);

                const qrList = document.getElementById('qrList');
                if (qrList.querySelector('.text-gray-500')) {
                    qrList.innerHTML = '';
                }

                const qrElement = document.createElement('div');
                qrElement.className =
                    'relative group cursor-move bg-white p-4 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105';
                qrElement.draggable = true;
                qrElement.innerHTML = `
                    <img src="${imageSrc}" class="w-20 h-20 mx-auto rounded-lg" alt="QR Code">
                    <p class="text-xs text-center mt-2 text-gray-600 truncate">${label}</p>
                `;

                qrElement.addEventListener('dragstart', (e) => {
                    this.draggedQR = qrItem;
                    qrElement.classList.add('opacity-50');
                });

                qrElement.addEventListener('dragend', () => {
                    qrElement.classList.remove('opacity-50');
                });

                qrList.appendChild(qrElement);
            }

            addQRToPage(pageIndex, qrData, x, y) {
                const page = this.pages[pageIndex];
                if (!page) return;

                const overlay = document.createElement('div');
                overlay.className = 'qr-overlay';
                overlay.style.left = Math.max(0, Math.min(x, page.viewport.width - 100)) + 'px';
                overlay.style.top = Math.max(0, Math.min(y, page.viewport.height - 100)) + 'px';
                overlay.style.width = '100px';
                overlay.style.height = '100px';

                const img = document.createElement('img');
                img.src = qrData.src;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'contain';
                overlay.appendChild(img);

                // Add resize handles
                ['nw', 'ne', 'sw', 'se'].forEach(pos => {
                    const handle = document.createElement('div');
                    handle.className = `resize-handle ${pos}`;
                    handle.addEventListener('mousedown', (e) => this.startResize(e, overlay, pos));
                    overlay.appendChild(handle);
                });

                // Add drag functionality
                overlay.addEventListener('mousedown', (e) => this.startDrag(e, overlay));

                // Add delete functionality (double-click)
                overlay.addEventListener('dblclick', () => {
                    overlay.remove();
                    const index = page.qrOverlays.indexOf(overlay);
                    if (index > -1) page.qrOverlays.splice(index, 1);
                });

                page.container.appendChild(overlay);
                page.qrOverlays.push(overlay);
            }

            startDrag(e, overlay) {
                if (this.isResizing) return;

                e.preventDefault();
                e.stopPropagation();

                this.selectedQROverlay = overlay;
                overlay.classList.add('dragging');

                const rect = overlay.getBoundingClientRect();
                const containerRect = overlay.parentElement.getBoundingClientRect();

                this.dragOffset = {
                    x: e.clientX - rect.left,
                    y: e.clientY - rect.top
                };
            }

            startResize(e, overlay, handle) {
                e.preventDefault();
                e.stopPropagation();

                this.isResizing = true;
                this.selectedQROverlay = overlay;
                this.resizeHandle = handle;

                const rect = overlay.getBoundingClientRect();
                this.resizeStart = {
                    x: e.clientX,
                    y: e.clientY,
                    width: rect.width,
                    height: rect.height,
                    left: rect.left,
                    top: rect.top
                };
            }

            handleGlobalMouseMove(e) {
                if (this.selectedQROverlay && !this.isResizing) {
                    // Dragging
                    const containerRect = this.selectedQROverlay.parentElement.getBoundingClientRect();
                    const newX = e.clientX - containerRect.left - this.dragOffset.x;
                    const newY = e.clientY - containerRect.top - this.dragOffset.y;

                    const maxX = containerRect.width - this.selectedQROverlay.offsetWidth;
                    const maxY = containerRect.height - this.selectedQROverlay.offsetHeight;

                    this.selectedQROverlay.style.left = Math.max(0, Math.min(newX, maxX)) + 'px';
                    this.selectedQROverlay.style.top = Math.max(0, Math.min(newY, maxY)) + 'px';

                } else if (this.isResizing && this.selectedQROverlay) {
                    // Resizing
                    const dx = e.clientX - this.resizeStart.x;
                    const dy = e.clientY - this.resizeStart.y;

                    let newWidth = this.resizeStart.width;
                    let newHeight = this.resizeStart.height;
                    let newLeft = parseInt(this.selectedQROverlay.style.left);
                    let newTop = parseInt(this.selectedQROverlay.style.top);

                    switch (this.resizeHandle) {
                        case 'se':
                            newWidth = Math.max(50, this.resizeStart.width + dx);
                            newHeight = Math.max(50, this.resizeStart.height + dy);
                            break;
                        case 'sw':
                            newWidth = Math.max(50, this.resizeStart.width - dx);
                            newHeight = Math.max(50, this.resizeStart.height + dy);
                            newLeft = this.resizeStart.left - (newWidth - this.resizeStart.width);
                            break;
                        case 'ne':
                            newWidth = Math.max(50, this.resizeStart.width + dx);
                            newHeight = Math.max(50, this.resizeStart.height - dy);
                            newTop = this.resizeStart.top - (newHeight - this.resizeStart.height);
                            break;
                        case 'nw':
                            newWidth = Math.max(50, this.resizeStart.width - dx);
                            newHeight = Math.max(50, this.resizeStart.height - dy);
                            newLeft = this.resizeStart.left - (newWidth - this.resizeStart.width);
                            newTop = this.resizeStart.top - (newHeight - this.resizeStart.height);
                            break;
                    }

                    // Keep aspect ratio
                    const size = Math.min(newWidth, newHeight);
                    this.selectedQROverlay.style.width = size + 'px';
                    this.selectedQROverlay.style.height = size + 'px';

                    if (['sw', 'nw'].includes(this.resizeHandle)) {
                        this.selectedQROverlay.style.left = (newLeft + (newWidth - size)) + 'px';
                    }
                    if (['ne', 'nw'].includes(this.resizeHandle)) {
                        this.selectedQROverlay.style.top = (newTop + (newHeight - size)) + 'px';
                    }
                }
            }

            handleGlobalMouseUp() {
                if (this.selectedQROverlay) {
                    this.selectedQROverlay.classList.remove('dragging');
                    this.selectedQROverlay = null;
                }
                this.isResizing = false;
                this.resizeHandle = null;
                this.dragOffset = null;
            }

            async submitPDF() {
                if (!this.originalPdfBytes) return;

                this.updateStatus('Generating PDF with QR codes...');

                try {
                    const pdfDoc = await PDFLib.PDFDocument.load(this.originalPdfBytes);

                    for (let pageIndex = 0; pageIndex < this.pages.length; pageIndex++) {
                        const page = this.pages[pageIndex];
                        const pdfPage = pdfDoc.getPage(pageIndex);
                        const {
                            width,
                            height
                        } = pdfPage.getSize();

                        // Scale factor from canvas to PDF
                        const scaleX = width / page.viewport.width;
                        const scaleY = height / page.viewport.height;

                        for (const overlay of page.qrOverlays) {
                            const img = overlay.querySelector('img');
                            const overlayRect = {
                                x: parseInt(overlay.style.left) * scaleX,
                                y: (page.viewport.height - parseInt(overlay.style.top) - overlay.offsetHeight) *
                                    scaleY,
                                width: overlay.offsetWidth * scaleX,
                                height: overlay.offsetHeight * scaleY
                            };

                            // Embed QR image
                            const qrImage = await pdfDoc.embedPng(img.src);

                            pdfPage.drawImage(qrImage, {
                                x: overlayRect.x,
                                y: overlayRect.y,
                                width: overlayRect.width,
                                height: overlayRect.height
                            });
                        }
                    }

                    const pdfBytes = await pdfDoc.save();

                    // Download
                    const blob = new Blob([pdfBytes], {
                        type: 'application/pdf'
                    });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.target = '_blank';
                    // a.download = 'pdf-with-qr-codes.pdf';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);

                    this.updateStatus('PDF downloaded successfully!');

                } catch (error) {
                    console.error('Error generating PDF:', error);
                    this.updateStatus('Error generating PDF');
                }
            }

            updateStatus(message) {
                document.getElementById('status').textContent = message;
                setTimeout(() => {
                    document.getElementById('status').textContent = '';
                }, 3000);
            }
        }

        // Initialize the editor
        new QRPDFEditor();
    </script>
</body>

</html>
