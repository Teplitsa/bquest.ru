#!/bin/bash
hg pull -u
./symfony cc
./symfony clear:apc bquest.ru
./symfony doctrine:migrate
