<?php


/**
 * Base class that represents a query for the 'buch' table.
 *
 *
 *
 * @method BuchQuery orderByISBN($order = Criteria::ASC) Order by the isbn column
 * @method BuchQuery orderByTitel($order = Criteria::ASC) Order by the titel column
 * @method BuchQuery orderByAutor_ID($order = Criteria::ASC) Order by the autor_id column
 * @method BuchQuery orderByVerlag_ID($order = Criteria::ASC) Order by the verlag_id column
 *
 * @method BuchQuery groupByISBN() Group by the isbn column
 * @method BuchQuery groupByTitel() Group by the titel column
 * @method BuchQuery groupByAutor_ID() Group by the autor_id column
 * @method BuchQuery groupByVerlag_ID() Group by the verlag_id column
 *
 * @method BuchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BuchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BuchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BuchQuery leftJoinAutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Autor relation
 * @method BuchQuery rightJoinAutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Autor relation
 * @method BuchQuery innerJoinAutor($relationAlias = null) Adds a INNER JOIN clause to the query using the Autor relation
 *
 * @method BuchQuery leftJoinVerlag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Verlag relation
 * @method BuchQuery rightJoinVerlag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Verlag relation
 * @method BuchQuery innerJoinVerlag($relationAlias = null) Adds a INNER JOIN clause to the query using the Verlag relation
 *
 * @method Buch findOne(PropelPDO $con = null) Return the first Buch matching the query
 * @method Buch findOneOrCreate(PropelPDO $con = null) Return the first Buch matching the query, or a new Buch object populated from the query conditions when no match is found
 *
 * @method Buch findOneByTitel(string $titel) Return the first Buch filtered by the titel column
 * @method Buch findOneByAutor_ID(int $autor_id) Return the first Buch filtered by the autor_id column
 * @method Buch findOneByVerlag_ID(int $verlag_id) Return the first Buch filtered by the verlag_id column
 *
 * @method array findByISBN(string $isbn) Return Buch objects filtered by the isbn column
 * @method array findByTitel(string $titel) Return Buch objects filtered by the titel column
 * @method array findByAutor_ID(int $autor_id) Return Buch objects filtered by the autor_id column
 * @method array findByVerlag_ID(int $verlag_id) Return Buch objects filtered by the verlag_id column
 *
 * @package    propel.generator.Buch.om
 */
abstract class BaseBuchQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBuchQuery object.
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
            $modelName = 'Buch';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BuchQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BuchQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BuchQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BuchQuery) {
            return $criteria;
        }
        $query = new BuchQuery(null, null, $modelAlias);

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
     * @return   Buch|Buch[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BuchPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BuchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Buch A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByISBN($key, $con = null)
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
     * @return                 Buch A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `isbn`, `titel`, `autor_id`, `verlag_id` FROM `buch` WHERE `isbn` = :p0';
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
            $obj = new Buch();
            $obj->hydrate($row);
            BuchPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Buch|Buch[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Buch[]|mixed the list of results, formatted by the current formatter
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
     * @return BuchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BuchPeer::ISBN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BuchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BuchPeer::ISBN, $keys, Criteria::IN);
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
     * @return BuchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BuchPeer::ISBN, $iSBN, $comparison);
    }

    /**
     * Filter the query on the titel column
     *
     * Example usage:
     * <code>
     * $query->filterByTitel('fooValue');   // WHERE titel = 'fooValue'
     * $query->filterByTitel('%fooValue%'); // WHERE titel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BuchQuery The current query, for fluid interface
     */
    public function filterByTitel($titel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titel)) {
                $titel = str_replace('*', '%', $titel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BuchPeer::TITEL, $titel, $comparison);
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
     * @return BuchQuery The current query, for fluid interface
     */
    public function filterByAutor_ID($autor_ID = null, $comparison = null)
    {
        if (is_array($autor_ID)) {
            $useMinMax = false;
            if (isset($autor_ID['min'])) {
                $this->addUsingAlias(BuchPeer::AUTOR_ID, $autor_ID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autor_ID['max'])) {
                $this->addUsingAlias(BuchPeer::AUTOR_ID, $autor_ID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BuchPeer::AUTOR_ID, $autor_ID, $comparison);
    }

    /**
     * Filter the query on the verlag_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVerlag_ID(1234); // WHERE verlag_id = 1234
     * $query->filterByVerlag_ID(array(12, 34)); // WHERE verlag_id IN (12, 34)
     * $query->filterByVerlag_ID(array('min' => 12)); // WHERE verlag_id >= 12
     * $query->filterByVerlag_ID(array('max' => 12)); // WHERE verlag_id <= 12
     * </code>
     *
     * @see       filterByVerlag()
     *
     * @param     mixed $verlag_ID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BuchQuery The current query, for fluid interface
     */
    public function filterByVerlag_ID($verlag_ID = null, $comparison = null)
    {
        if (is_array($verlag_ID)) {
            $useMinMax = false;
            if (isset($verlag_ID['min'])) {
                $this->addUsingAlias(BuchPeer::VERLAG_ID, $verlag_ID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verlag_ID['max'])) {
                $this->addUsingAlias(BuchPeer::VERLAG_ID, $verlag_ID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BuchPeer::VERLAG_ID, $verlag_ID, $comparison);
    }

    /**
     * Filter the query by a related Autor object
     *
     * @param   Autor|PropelObjectCollection $autor The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BuchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAutor($autor, $comparison = null)
    {
        if ($autor instanceof Autor) {
            return $this
                ->addUsingAlias(BuchPeer::AUTOR_ID, $autor->getID(), $comparison);
        } elseif ($autor instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BuchPeer::AUTOR_ID, $autor->toKeyValue('PrimaryKey', 'ID'), $comparison);
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
     * @return BuchQuery The current query, for fluid interface
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
     * Filter the query by a related Verlag object
     *
     * @param   Verlag|PropelObjectCollection $verlag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BuchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByVerlag($verlag, $comparison = null)
    {
        if ($verlag instanceof Verlag) {
            return $this
                ->addUsingAlias(BuchPeer::VERLAG_ID, $verlag->getID(), $comparison);
        } elseif ($verlag instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BuchPeer::VERLAG_ID, $verlag->toKeyValue('PrimaryKey', 'ID'), $comparison);
        } else {
            throw new PropelException('filterByVerlag() only accepts arguments of type Verlag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Verlag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BuchQuery The current query, for fluid interface
     */
    public function joinVerlag($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Verlag');

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
            $this->addJoinObject($join, 'Verlag');
        }

        return $this;
    }

    /**
     * Use the Verlag relation Verlag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   VerlagQuery A secondary query class using the current class as primary query
     */
    public function useVerlagQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVerlag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Verlag', 'VerlagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Buch $buch Object to remove from the list of results
     *
     * @return BuchQuery The current query, for fluid interface
     */
    public function prune($buch = null)
    {
        if ($buch) {
            $this->addUsingAlias(BuchPeer::ISBN, $buch->getISBN(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
