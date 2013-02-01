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
TEMP_FILE=$DIR"/tmp_853fb78b78oneyun44389"

if [ $# -eq 3 ]
then
    USER_PASS=" -u$USER -p$3"
fi

mysqldump $USER_PASS \
--skip-triggers --no-create-info --replace \
$DATABASE \
dm_area \
dm_auto_seo \
dm_auto_seo_translation \
dm_catalogue \
dm_group \
dm_group_permission \
dm_layout \
dm_mail_template \
dm_mail_template_translation \
dm_page \
dm_page_translation \
dm_page_view \
dm_permission \
dm_setting \
dm_setting_translation \
dm_widget \
dm_widget_translation \
dm_zone  \
> $DUMP_FILE

cat $DIR"/foreign_keys_disable.sql" $DUMP_FILE $DIR"/foreign_keys_enable.sql" > $TEMP_FILE
rm $DUMP_FILE
mv $TEMP_FILE $DUMP_FILE
