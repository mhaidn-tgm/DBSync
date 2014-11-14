<?php


/**
 * Base class that represents a query for the 'verlag' table.
 *
 *
 *
 * @method VerlagQuery orderByID($order = Criteria::ASC) Order by the id column
 * @method VerlagQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method VerlagQuery groupByID() Group by the id column
 * @method VerlagQuery groupByName() Group by the name column
 *
 * @method VerlagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VerlagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VerlagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VerlagQuery leftJoinBuch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Buch relation
 * @method VerlagQuery rightJoinBuch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Buch relation
 * @method VerlagQuery innerJoinBuch($relationAlias = null) Adds a INNER JOIN clause to the query using the Buch relation
 *
 * @method Verlag findOne(PropelPDO $con = null) Return the first Verlag matching the query
 * @method Verlag findOneOrCreate(PropelPDO $con = null) Return the first Verlag matching the query, or a new Verlag object populated from the query conditions when no match is found
 *
 * @method Verlag findOneByName(string $name) Return the first Verlag filtered by the name column
 *
 * @method array findByID(int $id) Return Verlag objects filtered by the id column
 * @method array findByName(string $name) Return Verlag objects filtered by the name column
 *
 * @package    propel.generator.Buch.om
 */
abstract class BaseVerlagQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVerlagQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'Buch';
        }
        if (null === $modelName) {
            $modelName = 'Verlag';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VerlagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VerlagQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VerlagQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VerlagQuery) {
            return $criteria;
        }
        $query = new VerlagQuery(null, null, $modelAlias);

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
     * @return   Verlag|Verlag[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VerlagPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VerlagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Verlag A model object, or null if the key is not found
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
     * @return                 Verlag A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name` FROM `verlag` WHERE `id` = :p0';
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
            $obj = new Verlag();
            $obj->hydrate($row);
            VerlagPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Verlag|Verlag[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Verlag[]|mixed the list of results, formatted by the current formatter
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
     * @return VerlagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VerlagPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VerlagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VerlagPeer::ID, $keys, Criteria::IN);
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
     * @return VerlagQuery The current query, for fluid interface
     */
    public function filterByID($iD = null, $comparison = null)
    {
        if (is_array($iD)) {
            $useMinMax = false;
            if (isset($iD['min'])) {
                $this->addUsingAlias(VerlagPeer::ID, $iD['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iD['max'])) {
                $this->addUsingAlias(VerlagPeer::ID, $iD['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VerlagPeer::ID, $iD, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VerlagQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VerlagPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Buch object
     *
     * @param   Buch|PropelObjectCollection $buch  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 VerlagQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBuch($buch, $comparison = null)
    {
        if ($buch instanceof Buch) {
            return $this
                ->addUsingAlias(VerlagPeer::ID, $buch->getVerlag_ID(), $comparison);
        } elseif ($buch instanceof PropelObjectCollection) {
            return $this
                ->useBuchQuery()
                ->filterByPrimaryKeys($buch->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBuch() only accepts arguments of type Buch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Buch relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VerlagQuery The current query, for fluid interface
     */
    public function joinBuch($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Buch');

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
            $this->addJoinObject($join, 'Buch');
        }

        return $this;
    }

    /**
     * Use the Buch relation Buch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BuchQuery A secondary query class using the current class as primary query
     */
    public function useBuchQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBuch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Buch', 'BuchQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Verlag $verlag Object to remove from the list of results
     *
     * @return VerlagQuery The current query, for fluid interface
     */
    public function prune($verlag = null)
    {
        if ($verlag) {
            $this->addUsingAlias(VerlagPeer::ID, $verlag->getID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
