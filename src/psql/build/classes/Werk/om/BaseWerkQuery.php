<?php


/**
 * Base class that represents a query for the 'werk' table.
 *
 *
 *
 * @method WerkQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method WerkQuery orderByAutor_ID($order = Criteria::ASC) Order by the autor_id column
 * @method WerkQuery orderByISBN($order = Criteria::ASC) Order by the isbn column
 * @method WerkQuery orderByReleaseDate($order = Criteria::ASC) Order by the release column
 *
 * @method WerkQuery groupByName() Group by the name column
 * @method WerkQuery groupByAutor_ID() Group by the autor_id column
 * @method WerkQuery groupByISBN() Group by the isbn column
 * @method WerkQuery groupByReleaseDate() Group by the release column
 *
 * @method WerkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method WerkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method WerkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method WerkQuery leftJoinAutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Autor relation
 * @method WerkQuery rightJoinAutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Autor relation
 * @method WerkQuery innerJoinAutor($relationAlias = null) Adds a INNER JOIN clause to the query using the Autor relation
 *
 * @method Werk findOne(PropelPDO $con = null) Return the first Werk matching the query
 * @method Werk findOneOrCreate(PropelPDO $con = null) Return the first Werk matching the query, or a new Werk object populated from the query conditions when no match is found
 *
 * @method Werk findOneByAutor_ID(int $autor_id) Return the first Werk filtered by the autor_id column
 * @method Werk findOneByISBN(string $isbn) Return the first Werk filtered by the isbn column
 * @method Werk findOneByReleaseDate(string $release) Return the first Werk filtered by the release column
 *
 * @method array findByName(string $name) Return Werk objects filtered by the name column
 * @method array findByAutor_ID(int $autor_id) Return Werk objects filtered by the autor_id column
 * @method array findByISBN(string $isbn) Return Werk objects filtered by the isbn column
 * @method array findByReleaseDate(string $release) Return Werk objects filtered by the release column
 *
 * @package    propel.generator.Werk.om
 */
abstract class BaseWerkQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseWerkQuery object.
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
            $modelName = 'Werk';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new WerkQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   WerkQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return WerkQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof WerkQuery) {
            return $criteria;
        }
        $query = new WerkQuery(null, null, $modelAlias);

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
     * @return   Werk|Werk[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WerkPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(WerkPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Werk A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByName($key, $con = null)
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
     * @return                 Werk A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT "name", "autor_id", "isbn", "release" FROM "werk" WHERE "name" = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Werk();
            $obj->hydrate($row);
            WerkPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Werk|Werk[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Werk[]|mixed the list of results, formatted by the current formatter
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
     * @return WerkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WerkPeer::NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WerkPeer::NAME, $keys, Criteria::IN);
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
     * @return WerkQuery The current query, for fluid interface
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

        return $this->addUsingAlias(WerkPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the autor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAutor_ID(1234); // WHERE autor_id = 1234
     * $query->filterByAutor_ID(array(12, 34)); // WHERE autor_id IN (12, 34)
     * $query->filterByAutor_ID(array('min' => 12)); // WHERE autor_id >= 12
     * $query->filterByAutor_ID(array('max' => 12)); // WHERE autor_id <= 12
     * </code>
     *
     * @see       filterByAutor()
     *
     * @param     mixed $autor_ID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function filterByAutor_ID($autor_ID = null, $comparison = null)
    {
        if (is_array($autor_ID)) {
            $useMinMax = false;
            if (isset($autor_ID['min'])) {
                $this->addUsingAlias(WerkPeer::AUTOR_ID, $autor_ID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autor_ID['max'])) {
                $this->addUsingAlias(WerkPeer::AUTOR_ID, $autor_ID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WerkPeer::AUTOR_ID, $autor_ID, $comparison);
    }

    /**
     * Filter the query on the isbn column
     *
     * Example usage:
     * <code>
     * $query->filterByISBN('fooValue');   // WHERE isbn = 'fooValue'
     * $query->filterByISBN('%fooValue%'); // WHERE isbn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $iSBN The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function filterByISBN($iSBN = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($iSBN)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $iSBN)) {
                $iSBN = str_replace('*', '%', $iSBN);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WerkPeer::ISBN, $iSBN, $comparison);
    }

    /**
     * Filter the query on the release column
     *
     * Example usage:
     * <code>
     * $query->filterByReleaseDate('2011-03-14'); // WHERE release = '2011-03-14'
     * $query->filterByReleaseDate('now'); // WHERE release = '2011-03-14'
     * $query->filterByReleaseDate(array('max' => 'yesterday')); // WHERE release < '2011-03-13'
     * </code>
     *
     * @param     mixed $releaseDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function filterByReleaseDate($releaseDate = null, $comparison = null)
    {
        if (is_array($releaseDate)) {
            $useMinMax = false;
            if (isset($releaseDate['min'])) {
                $this->addUsingAlias(WerkPeer::RELEASE, $releaseDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($releaseDate['max'])) {
                $this->addUsingAlias(WerkPeer::RELEASE, $releaseDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WerkPeer::RELEASE, $releaseDate, $comparison);
    }

    /**
     * Filter the query by a related Autor object
     *
     * @param   Autor|PropelObjectCollection $autor The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 WerkQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAutor($autor, $comparison = null)
    {
        if ($autor instanceof Autor) {
            return $this
                ->addUsingAlias(WerkPeer::AUTOR_ID, $autor->getID(), $comparison);
        } elseif ($autor instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WerkPeer::AUTOR_ID, $autor->toKeyValue('PrimaryKey', 'ID'), $comparison);
        } else {
            throw new PropelException('filterByAutor() only accepts arguments of type Autor or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Autor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function joinAutor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Autor');

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
            $this->addJoinObject($join, 'Autor');
        }

        return $this;
    }

    /**
     * Use the Autor relation Autor object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AutorQuery A secondary query class using the current class as primary query
     */
    public function useAutorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAutor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Autor', 'AutorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Werk $werk Object to remove from the list of results
     *
     * @return WerkQuery The current query, for fluid interface
     */
    public function prune($werk = null)
    {
        if ($werk) {
            $this->addUsingAlias(WerkPeer::NAME, $werk->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
