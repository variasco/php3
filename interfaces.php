<?

interface ConnectionInterface
{
}

interface RecordInterface
{
}

interface QueryBuilderInterface
{
}

interface DBFactoryInterface
{
    function DBConnection(): ConnectionInterface;
    function DBRecord(): RecordInterface;
    function DBQueryBuiler(): QueryBuilderInterface;
}
