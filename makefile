BIN="${HOME}/bin/google_appengine"

default:
	"$(BIN)/appcfg.py" --oauth2 update ./

serve:
	"$(BIN)/dev_appserver.py" --datastore_path=./tmp/datastore ./

serve-clear:
	"$(BIN)/dev_appserver.py" --datastore_path=./tmp/datastore --clear_datastore ./

serve-php:
	php -S localhost:8000
