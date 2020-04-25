path="$1"
if [ -z "$path" ];
then
  echo "inserire un path"
  exit
fi

if [ ! -d "$path" ];
then
  echo "la directory $path non esiste"
  exit
fi
source /Users/pier/help/bin/activate
mkdocs build
cp -Ra site/* $path