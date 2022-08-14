<?

class MySQLFactory implements DBFactoryInterface
{
    function DBConnection(): ConnectionInterface
    {
        return new MySQLConnection();
    }

    function DBRecord(): RecordInterface
    {
        return new MySQLRecord();
    }

    function DBQueryBuiler(): QueryBuilderInterface
    {
        return new MySQLQuerryBuilder();
    }
}

class PostgreSQLFactory implements DBFactoryInterface
{
    function DBConnection(): ConnectionInterface
    {
        return new PostgreSQLConnection();
    }

    function DBRecord(): RecordInterface
    {
        return new PostgreSQLRecord();
    }

    function DBQueryBuiler(): QueryBuilderInterface
    {
        return new PostgreSQLQuerryBuilder();
    }
}

class OracleFactory implements DBFactoryInterface
{
    function DBConnection(): ConnectionInterface
    {
        return new OracleConnection();
    }

    function DBRecord(): RecordInterface
    {
        return new OracleRecord();
    }

    function DBQueryBuiler(): QueryBuilderInterface
    {
        return new OracleQuerryBuilder();
    }
}
