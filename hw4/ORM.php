<?

class ORM
{
    protected $connection;
    protected $record;
    protected $queryBuilder;

    public function __construct(DBFactoryInterface $factory)
    {
        $this->connection = $factory->DBConnection();
        $this->record = $factory->DBRecord();
        $this->queryBuilder = $factory->DBQueryBuiler();
    }
}
