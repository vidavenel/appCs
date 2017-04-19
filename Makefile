build:
	# Download composer dependencies
	docker run --rm -v $(PWD):/app composer install
	# Download npm dependencies
	docker run --rm -v $(PWD):/app -w /app node npm install

