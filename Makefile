serve:
	docker build -t sukamanis -f ops/Dockerfile .
	docker run --rm -p 9000:80 -v $(PWD):/var/www sukamanis