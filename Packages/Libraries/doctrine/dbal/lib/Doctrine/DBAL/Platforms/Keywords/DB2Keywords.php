<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\DBAL\Platforms\Keywords;

/**
 * DB2 Keywords.
 *
 * @link   www.doctrine-project.org
 * @since  2.0
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class DB2Keywords extends KeywordList
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DB2';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKeywords()
    {
        return array(
            'ACTIVATE',
            'ADD',
            'AFTER',
            'ALIAS',
            'ALL',
            'ALLOCATE',
            'DOCUMENT',
            'DOUBLE',
            'DROP',
            'DSSIZE',
            'DYNAMIC',
            'EACH',
            'LOCK',
            'LOCKMAX',
            'LOCKSIZE',
            'LONG',
            'LOOP',
            'MAINTAINED',
            'ROUND_CEILING',
            'ROUND_DOWN',
            'ROUND_FLOOR',
            'ROUND_HALF_DOWN',
            'ROUND_HALF_EVEN',
            'ROUND_HALF_UP',
            'ALLOW',
            'ALTER',
            'AND',
            'ANY',
            'AS',
            'ASENSITIVE',
            'ASSOCIATE',
            'ASUTIME',
            'AT',
            'ATTRIBUTES',
            'AUDIT',
            'AUTHORIZATION',
            'AUX',
            'AUXILIARY',
            'BEFORE',
            'BEGIN',
            'BETWEEN',
            'BINARY',
            'BUFFERPOOL',
            'BY',
            'CACHE',
            'CALL',
            'CALLED',
            'CAPTURE',
            'CARDINALITY',
            'CASCADED',
            'CASE',
            'CAST',
            'CCSID',
            'CHAR',
            'CHARACTER',
            'CHECK',
            'CLONE',
            'CLOSE',
            'CLUSTER',
            'COLLECTION',
            'COLLID',
            'COLUMN',
            'COMMENT',
            'COMMIT',
            'CONCAT',
            'CONDITION',
            'CONNECT',
            'CONNECTION',
            'CONSTRAINT',
            'CONTAINS',
            'CONTINUE',
            'COUNT',
            'COUNT_BIG',
            'CREATE',
            'CROSS',
            'CURRENT',
            'CURRENT_DATE',
            'CURRENT_LC_CTYPE',
            'CURRENT_PATH',
            'CURRENT_SCHEMA',
            'CURRENT_SERVER',
            'CURRENT_TIME',
            'CURRENT_TIMESTAMP',
            'CURRENT_TIMEZONE',
            'CURRENT_USER',
            'CURSOR',
            'CYCLE',
            'DATA',
            'DATABASE',
            'DATAPARTITIONNAME',
            'DATAPARTITIONNUM',
            'EDITPROC',
            'ELSE',
            'ELSEIF',
            'ENABLE',
            'ENCODING',
            'ENCRYPTION',
            'END',
            'END-EXEC',
            'ENDING',
            'ERASE',
            'ESCAPE',
            'EVERY',
            'EXCEPT',
            'EXCEPTION',
            'EXCLUDING',
            'EXCLUSIVE',
            'EXECUTE',
            'EXISTS',
            'EXIT',
            'EXPLAIN',
            'EXTERNAL',
            'EXTRACT',
            'FENCED',
            'FETCH',
            'FIELDPROC',
            'FILE',
            'FINAL',
            'FOR',
            'FOREIGN',
            'FREE',
            'FROM',
            'FULL',
            'FUNCTION',
            'GENERAL',
            'GENERATED',
            'GET',
            'GLOBAL',
            'GO',
            'GOTO',
            'GRANT',
            'GRAPHIC',
            'GROUP',
            'HANDLER',
            'HASH',
            'HASHED_VALUE',
            'HAVING',
            'HINT',
            'HOLD',
            'HOUR',
            'HOURS',
            'IDENTITY',
            'IF',
            'IMMEDIATE',
            'IN',
            'INCLUDING',
            'INCLUSIVE',
            'INCREMENT',
            'INDEX',
            'INDICATOR',
            'INF',
            'INFINITY',
            'INHERIT',
            'INNER',
            'INOUT',
            'INSENSITIVE',
            'INSERT',
            'INTEGRITY',
            'MATERIALIZED',
            'MAXVALUE',
            'MICROSECOND',
            'MICROSECONDS',
            'MINUTE',
            'MINUTES',
            'MINVALUE',
            'MODE',
            'MODIFIES',
            'MONTH',
            'MONTHS',
            'NAN',
            'NEW',
            'NEW_TABLE',
            'NEXTVAL',
            'NO',
            'NOCACHE',
            'NOCYCLE',
            'NODENAME',
            'NODENUMBER',
            'NOMAXVALUE',
            'NOMINVALUE',
            'NONE',
            'NOORDER',
            'NORMALIZED',
            'NOT',
            'NULL',
            'NULLS',
            'NUMPARTS',
            'OBID',
            'OF',
            'OLD',
            'OLD_TABLE',
            'ON',
            'OPEN',
            'OPTIMIZATION',
            'OPTIMIZE',
            'OPTION',
            'OR',
            'ORDER',
            'OUT',
            'OUTER',
            'OVER',
            'OVERRIDING',
            'PACKAGE',
            'PADDED',
            'PAGESIZE',
            'PARAMETER',
            'PART',
            'PARTITION',
            'PARTITIONED',
            'PARTITIONING',
            'PARTITIONS',
            'PASSWORD',
            'PATH',
            'PIECESIZE',
            'PLAN',
            'POSITION',
            'PRECISION',
            'PREPARE',
            'PREVVAL',
            'PRIMARY',
            'PRIQTY',
            'PRIVILEGES',
            'PROCEDURE',
            'PROGRAM',
            'PSID',
            'ROUND_UP',
            'ROUTINE',
            'ROW',
            'ROW_NUMBER',
            'ROWNUMBER',
            'ROWS',
            'ROWSET',
            'RRN',
            'RUN',
            'SAVEPOINT',
            'SCHEMA',
            'SCRATCHPAD',
            'SCROLL',
            'SEARCH',
            'SECOND',
            'SECONDS',
            'SECQTY',
            'SECURITY',
            'SELECT',
            'SENSITIVE',
            'SEQUENCE',
            'SESSION',
            'SESSION_USER',
            'SET',
            'SIGNAL',
            'SIMPLE',
            'SNAN',
            'SOME',
            'SOURCE',
            'SPECIFIC',
            'SQL',
            'SQLID',
            'STACKED',
            'STANDARD',
            'START',
            'STARTING',
            'STATEMENT',
            'STATIC',
            'STATMENT',
            'STAY',
            'STOGROUP',
            'STORES',
            'STYLE',
            'SUBSTRING',
            'SUMMARY',
            'SYNONYM',
            'SYSFUN',
            'SYSIBM',
            'SYSPROC',
            'SYSTEM',
            'SYSTEM_USER',
            'TABLE',
            'TABLESPACE',
            'THEN',
            'TIME',
            'TIMESTAMP',
            'TO',
            'TRANSACTION',
            'TRIGGER',
            'TRIM',
            'TRUNCATE',
            'TYPE',
            'UNDO',
            'UNION',
            'UNIQUE',
            'UNTIL',
            'UPDATE',
            'DATE',
            'DAY',
            'DAYS',
            'DB2GENERAL',
            'DB2GENRL',
            'DB2SQL',
            'DBINFO',
            'DBPARTITIONNAME',
            'DBPARTITIONNUM',
            'DEALLOCATE',
            'DECLARE',
            'DEFAULT',
            'DEFAULTS',
            'DEFINITION',
            'DELETE',
            'DENSE_RANK',
            'DENSERANK',
            'DESCRIBE',
            'DESCRIPTOR',
            'DETERMINISTIC',
            'DIAGNOSTICS',
            'DISABLE',
            'DISALLOW',
            'DISCONNECT',
            'DISTINCT',
            'DO',
            'INTERSECT',
            'PUBLIC',
            'USAGE',
            'INTO',
            'QUERY',
            'USER',
            'IS',
            'QUERYNO',
            'USING',
            'ISOBID',
            'RANGE',
            'VALIDPROC',
            'ISOLATION',
            'RANK',
            'VALUE',
            'ITERATE',
            'READ',
            'VALUES',
            'JAR',
            'READS',
            'VARIABLE',
            'JAVA',
            'RECOVERY',
            'VARIANT',
            'JOIN',
            'REFERENCES',
            'VCAT',
            'KEEP',
            'REFERENCING',
            'VERSION',
            'KEY',
            'REFRESH',
            'VIEW',
            'LABEL',
            'RELEASE',
            'VOLATILE',
            'LANGUAGE',
            'RENAME',
            'VOLUMES',
            'LATERAL',
            'REPEAT',
            'WHEN',
            'LC_CTYPE',
            'RESET',
            'WHENEVER',
            'LEAVE',
            'RESIGNAL',
            'WHERE',
            'LEFT',
            'RESTART',
            'WHILE',
            'LIKE',
            'RESTRICT',
            'WITH',
            'LINKTYPE',
            'RESULT',
            'WITHOUT',
            'LOCAL',
            'RESULT_SET_LOCATOR WLM',
            'LOCALDATE',
            'RETURN',
            'WRITE',
            'LOCALE',
            'RETURNS',
            'XMLELEMENT',
            'LOCALTIME',
            'REVOKE',
            'XMLEXISTS',
            'LOCALTIMESTAMP RIGHT',
            'XMLNAMESPACES',
            'LOCATOR',
            'ROLE',
            'YEAR',
            'LOCATORS',
            'ROLLBACK',
            'YEARS',
        );
    }
}
