#!/bin/sh

##
##  Load a LibreSignage build config file. If $1 is a valid
##  filepath, load the config from that path. Otherwise use
##  the last generated config that should be symlinked in 
##  build/link/last.conf.
##

set -e

if [ -n "$1" ]; then
	. "$1"
else
	if [ -f "build/link/last.conf" ]; then
		. "build/link/last.conf"
	else
		echo "[Error] Build config doesn't exist. Did you run 'make configure'?"
		exit 1
	fi
fi
