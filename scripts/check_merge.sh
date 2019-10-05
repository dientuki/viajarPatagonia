#!/bin/bash

echo "Testing the merge erros on all files"

if fgrep "<<<<<<<" -r --exclude-dir=fonts; then exit 1
fi

if fgrep ">>>>>>>" -r --exclude-dir=fonts; then exit 1
fi