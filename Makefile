build:
	docker build -t tcc-extensao-universitaria .

run:
	docker run --rm \
        -p 8000:80 \
        tcc-extensao-universitaria
