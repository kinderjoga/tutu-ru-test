
install: #instal composer
	@composer install

validate: #validate composer
	@composer validate

evil-clown: #run EvilClown
	@php ./bin/test-evilclown

hipsters: #run Hipsters
	@php ./bin/test-hipsters

treasure: #run Treasure
	@php ./bin/test-treasure

lint: #validate code
	@composer exec --verbose phpcs -- --standard=PSR12 src bin
	