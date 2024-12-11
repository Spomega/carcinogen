code-sniffer:
	vendor/bin/phpcs --standard=ruleset.xml --extensions=php --tab-width=4 -sp src tests

fix-code:
	vendor/bin/phpcbf --standard=ruleset.xml --extensions=php --tab-width=4 -sp src tests