#!/bin/bash
#
# Diem site configuration export script
# The idea is to automate deploy to production with site configuration, sush as new pages, widget, mail-templates & etc.
# If you create some page or change other site configuration, this script can export it, and you can add dump file to
# your VCS, and import it during the deploy.
#
# Written by Maksim Borisov <maksim.i.borisov@gmail.com>
# Written by Alexander Salikov <salikov57@gmail.com>
#

if [ $# -lt 2 ]
then
    echo "Usage: $0 database user [pass]"
    exit 1
fi

DATABASE=$1
USER=$2
USER_PASS="-u$2"
DIR=$( cd "$( dirname "$0" )" && pwd )
DUMP_FILE=$DIR"/base_schema_dump.sql"

if [ $# -eq 3 ]
then
    USER_PASS=" -u$USER -p$3"
fi

mysql $USER_PASS $DATABASE < $DUMP_FILE
