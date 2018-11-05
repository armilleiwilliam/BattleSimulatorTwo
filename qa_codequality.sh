#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
#if you whant to autoformat run "${DIR}/vendor/squizlabs/php_codesniffer/bin/phpcsphpcs" # put final 'cs' or 'cbf' if cbf just show how many fixes
BIN_CS="${DIR}/vendor/squizlabs/php_codesniffer/bin/phpcs" # put final 'cs' or 'cbf' if cbf show only the number of fixes, while cs also which lines
BIN_GIT=`which git`

LOG_DIR='build/logs'
LOG_FILE="${DIR}/${LOG_DIR}/phpcs.xml"

CURRENT_BRANCH=`${BIN_GIT} rev-parse --abbrev-ref HEAD`

#cd ${DIR}/..

if [[ -z "${1}" ]]; then

  MERGE_BASE=$(git merge-base ${CURRENT_BRANCH} develop)

  FILES_COMMIT=$(git diff --diff-filter=ACMRTUXB  --name-only ${MERGE_BASE} ${CURRENT_BRANCH} | grep -v DoctrineMigrations)
  FILES_STAGED=$(git diff --diff-filter=ACMRTUXB --name-only --staged | grep -v DoctrineMigrations)
  FILES_NON_STAGED=$(git diff --diff-filter=ACMRTUXB --name-only | grep -v DoctrineMigrations)

  declare -a FILES_KEYS
  for k in "${FILES_COMMIT[@]}" "${FILES_STAGED[@]}" "${FILES_NON_STAGED[@]}"; do
    if [[ ! -z "${k// }" ]]; then
        varKey= "${k}"
#      FILES_KEYS["${k}"]=1;
    fi
  done

  FILES=${!FILES_KEYS[@]}

  if [[ -z "${FILES}" ]]; then
    FILES="src/"
  fi
else
  FILES="${1}"
fi
#
${BIN_CS} ${FILES} --extensions=php --report-junit=${LOG_FILE} --report-full --standard=psr2