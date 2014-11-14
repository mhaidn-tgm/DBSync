<?php


/**
 * Base class that represents a query for the 'autor' table.
 *
 *
 *
 * @method AutorQuery orderByID($order = Criteria::ASC) Order by the id column
 * @method AutorQuery orderByGebDat($order = Criteria::ASC) Order by the gebdat column
 * @method AutorQuery orderByBeschreibung($order = Criteria::ASC) Order by the beschreibung column
 *
 * @method AutorQuery groupByID() Group by the id column
 * @method AutorQuery groupByGebDat() Group by the gebdat column
 * @method AutorQuery groupByBeschreibung() Group by the beschreibung column
 *
 * @method AutorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AutorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AutorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AutorQuery leftJoinWerk($relationAlias = null) Adds a LEFT JOIN clause to the query using the Werk relation
 * @method AutorQuery rightJoinWerk($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Werk relation
 * @method AutorQuery innerJoinWerk($relationAlias = null) Adds a INNER JOIN clause to the query using the Werk relation
 *
 * @method Autor findOne(PropelPDO $con = null) Return the first Autor matching the query
 * @method Autor findOneOrCreate(PropelPDO $con = null) Return the first Autor matching the query, or a new Autor object populated from the query conditions when no match is found
 *
 * @method Autor findOneByGebDat(string $gebdat) Return the first Autor filtered by the gebdat column
 * @method Autor findOneByBeschreibung(string $beschreibung) Return the first Autor filtered by the beschreibung column
 *
 * @method array findByID(int $id) Return Autor objects filtered by the id column
 * @method array findByGebDat(string $gebdat) Return Autor objects filtered by the gebdat column
 * @method array findByBeschreibung(string $beschreibung) Return Autor objects filtered by the beschreibung column
 *
 * @package    propel.generator.Werk.om
 */
abstract class BaseAutorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAutorQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'Werk';
        }
        if (null === $modelName) {
            $modelName = 'Autor';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AutorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   AutorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AutorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AutorQuery) {
            return $criteria;
        }
        $query = new AutorQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Autor|Autor[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AutorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AutorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Autor A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByID($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Autor A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT "id", "gebdat", "beschreibung" FROM "autor" WHERE "id" = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Autor();
            $obj->hydrate($row);
            AutorPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Autor|Autor[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Autor[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AutorPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AutorPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterByID(1234); // WHERE id = 1234
     * $query->filterByID(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterByID(array('min' => 12)); // WHERE id >= 12
     * $query->filterByID(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $iD The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByID($iD = null, $comparison = null)
    {
        if (is_array($iD)) {
            $useMinMax = false;
            if (isset($iD['min'])) {
                $this->addUsingAlias(AutorPeer::ID, $iD['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iD['max'])) {
                $this->addUsingAlias(AutorPeer::ID, $iD['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AutorPeer::ID, $iD, $comparison);
    }

    /**
     * Filter the query on the gebdat column
     *
     * Example usage:
     * <code>
     * $query->filterByGebDat('fooValue');   // WHERE gebdat = 'fooValue'
     * $query->filterByGebDat('%fooValue%'); // WHERE gebdat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gebDat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByGebDat($gebDat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gebDat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gebDat)) {
                $gebDat = str_replace('*', '%', $gebDat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorPeer::GEBDAT, $gebDat, $comparison);
    }

    /**
     * Filter the query on the beschreibung column
     *
     * Example usage:
     * <code>
     * $query->filterByBeschreibung('fooValue');   // WHERE beschreibung = 'fooValue'
     * $query->filterByBeschreibung('%fooValue%'); // WHERE beschreibung LIKE '%fooValue%'
     * </code>
     *
     * @param     string $beschreibung The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByBeschreibung($beschreibung = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beschreibung)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $beschreibung)) {
                $beschreibung = str_replace('*', '%', $beschreibung);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorPeer::BESCHREIBUNG, $beschreibung, $comparison);
    }

    /**
     * Filter the query by a related Werk object
     *
     * @param   Werk|PropelObjectCollection $werk  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 AutorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByWerk($werk, $comparison = null)
    {
        if ($werk instanceof Werk) {
            return $this
                ->addUsingAlias(AutorPeer::ID, $werk->getAutor_ID(), $comparison);
        } elseif ($werk instanceof PropelObjectCollection) {
            return $this
                ->useWerkQuery()
                ->filterByPrimaryKeys($werk->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWerk() only accepts arguments of type Werk or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Werk relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function joinWerk($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Werk');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Werk');
        }

        return $this;
    }

    /**
     * Use the Werk relation Werk object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   WerkQuery A secondary query class using the current class as primary query
     */
    public function useWerkQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWerk($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Werk', 'WerkQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Autor $autor Object to remove from the list of results
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function prune($autor = null)
    {
        if ($autor) {
            $this->addUsingAlias(AutorPeer::ID, $autor->getID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
