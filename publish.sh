path="$1"
if [ -z "$path" ]
then
  echo "inserire un path"
  exit
fi

source /Users/pier/help/bin/activate
mkdocs build
cp -Ra site/* $path