<?php


/**
 * Base class that represents a row from the 'buch' table.
 *
 *
 *
 * @package    propel.generator.Buch.om
 */
abstract class BaseBuch extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'BuchPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BuchPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the isbn field.
     * @var        string
     */
    protected $isbn;

    /**
     * The value for the titel field.
     * @var        string
     */
    protected $titel;

    /**
     * The value for the autor_id field.
     * @var        int
     */
    protected $autor_id;

    /**
     * The value for the verlag_id field.
     * @var        int
     */
    protected $verlag_id;

    /**
     * @var        Autor
     */
    protected $aAutor;

    /**
     * @var        Verlag
     */
    protected $aVerlag;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [isbn] column value.
     *
     * @return string
     */
    public function getISBN()
    {

        return $this->isbn;
    }

    /**
     * Get the [titel] column value.
     *
     * @return string
     */
    public function getTitel()
    {

        return $this->titel;
    }

    /**
     * Get the [autor_id] column value.
     *
     * @return int
     */
    public function getAutor_ID()
    {

        return $this->autor_id;
    }

    /**
     * Get the [verlag_id] column value.
     *
     * @return int
     */
    public function getVerlag_ID()
    {

        return $this->verlag_id;
    }

    /**
     * Set the value of [isbn] column.
     *
     * @param  string $v new value
     * @return Buch The current object (for fluent API support)
     */
    public function setISBN($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->isbn !== $v) {
            $this->isbn = $v;
            $this->modifiedColumns[] = BuchPeer::ISBN;
        }


        return $this;
    } // setISBN()

    /**
     * Set the value of [titel] column.
     *
     * @param  string $v new value
     * @return Buch The current object (for fluent API support)
     */
    public function setTitel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->titel !== $v) {
            $this->titel = $v;
            $this->modifiedColumns[] = BuchPeer::TITEL;
        }


        return $this;
    } // setTitel()

    /**
     * Set the value of [autor_id] column.
     *
     * @param  int $v new value
     * @return Buch The current object (for fluent API support)
     */
    public function setAutor_ID($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->autor_id !== $v) {
            $this->autor_id = $v;
            $this->modifiedColumns[] = BuchPeer::AUTOR_ID;
        }

        if ($this->aAutor !== null && $this->aAutor->getID() !== $v) {
            $this->aAutor = null;
        }


        return $this;
    } // setAutor_ID()

    /**
     * Set the value of [verlag_id] column.
     *
     * @param  int $v new value
     * @return Buch The current object (for fluent API support)
     */
    public function setVerlag_ID($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->verlag_id !== $v) {
            $this->verlag_id = $v;
            $this->modifiedColumns[] = BuchPeer::VERLAG_ID;
        }

        if ($this->aVerlag !== null && $this->aVerlag->getID() !== $v) {
            $this->aVerlag = null;
        }


        return $this;
    } // setVerlag_ID()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->isbn = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->titel = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->autor_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->verlag_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 4; // 4 = BuchPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Buch object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aAutor !== null && $this->autor_id !== $this->aAutor->getID()) {
            $this->aAutor = null;
        }
        if ($this->aVerlag !== null && $this->verlag_id !== $this->aVerlag->getID()) {
            $this->aVerlag = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BuchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BuchPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAutor = null;
            $this->aVerlag = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BuchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BuchQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BuchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                BuchPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAutor !== null) {
                if ($this->aAutor->isModified() || $this->aAutor->isNew()) {
                    $affectedRows += $this->aAutor->save($con);
                }
                $this->setAutor($this->aAutor);
            }

            if ($this->aVerlag !== null) {
                if ($this->aVerlag->isModified() || $this->aVerlag->isNew()) {
                    $affectedRows += $this->aVerlag->save($con);
                }
                $this->setVerlag($this->aVerlag);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BuchPeer::ISBN)) {
            $modifiedColumns[':p' . $index++]  = '`isbn`';
        }
        if ($this->isColumnModified(BuchPeer::TITEL)) {
            $modifiedColumns[':p' . $index++]  = '`titel`';
        }
        if ($this->isColumnModified(BuchPeer::AUTOR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`autor_id`';
        }
        if ($this->isColumnModified(BuchPeer::VERLAG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`verlag_id`';
        }

        $sql = sprintf(
            'INSERT INTO `buch` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`isbn`':
                        $stmt->bindValue($identifier, $this->isbn, PDO::PARAM_STR);
                        break;
                    case '`titel`':
                        $stmt->bindValue($identifier, $this->titel, PDO::PARAM_STR);
                        break;
                    case '`autor_id`':
                        $stmt->bindValue($identifier, $this->autor_id, PDO::PARAM_INT);
                        break;
                    case '`verlag_id`':
                        $stmt->bindValue($identifier, $this->verlag_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAutor !== null) {
                if (!$this->aAutor->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAutor->getValidationFailures());
                }
            }

            if ($this->aVerlag !== null) {
                if (!$this->aVerlag->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aVerlag->getValidationFailures());
                }
            }


            if (($retval = BuchPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BuchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getISBN();
                break;
            case 1:
                return $this->getTitel();
                break;
            case 2:
                return $this->getAutor_ID();
                break;
            case 3:
                return $this->getVerlag_ID();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Buch'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Buch'][$this->getPrimaryKey()] = true;
        $keys = BuchPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getISBN(),
            $keys[1] => $this->getTitel(),
            $keys[2] => $this->getAutor_ID(),
            $keys[3] => $this->getVerlag_ID(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAutor) {
                $result['Autor'] = $this->aAutor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVerlag) {
                $result['Verlag'] = $this->aVerlag->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BuchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setISBN($value);
                break;
            case 1:
                $this->setTitel($value);
                break;
            case 2:
                $this->setAutor_ID($value);
                break;
            case 3:
                $this->setVerlag_ID($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = BuchPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setISBN($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTitel($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAutor_ID($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setVerlag_ID($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BuchPeer::DATABASE_NAME);

        if ($this->isColumnModified(BuchPeer::ISBN)) $criteria->add(BuchPeer::ISBN, $this->isbn);
        if ($this->isColumnModified(BuchPeer::TITEL)) $criteria->add(BuchPeer::TITEL, $this->titel);
        if ($this->isColumnModified(BuchPeer::AUTOR_ID)) $criteria->add(BuchPeer::AUTOR_ID, $this->autor_id);
        if ($this->isColumnModified(BuchPeer::VERLAG_ID)) $criteria->add(BuchPeer::VERLAG_ID, $this->verlag_id);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(BuchPeer::DATABASE_NAME);
        $criteria->add(BuchPeer::ISBN, $this->isbn);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getISBN();
    }

    /**
     * Generic method to set the primary key (isbn column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setISBN($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getISBN();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Buch (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitel($this->getTitel());
        $copyObj->setAutor_ID($this->getAutor_ID());
        $copyObj->setVerlag_ID($this->getVerlag_ID());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setISBN(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Buch Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return BuchPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BuchPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Autor object.
     *
     * @param                  Autor $v
     * @return Buch The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAutor(Autor $v = null)
    {
        if ($v === null) {
            $this->setAutor_ID(NULL);
        } else {
            $this->setAutor_ID($v->getID());
        }

        $this->aAutor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Autor object, it will not be re-added.
        if ($v !== null) {
            $v->addBuch($this);
        }


        return $this;
    }


    /**
     * Get the associated Autor object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Autor The associated Autor object.
     * @throws PropelException
     */
    public function getAutor(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAutor === null && ($this->autor_id !== null) && $doQuery) {
            $this->aAutor = AutorQuery::create()->findPk($this->autor_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAutor->addBuchs($this);
             */
        }

        return $this->aAutor;
    }

    /**
     * Declares an association between this object and a Verlag object.
     *
     * @param                  Verlag $v
     * @return Buch The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVerlag(Verlag $v = null)
    {
        if ($v === null) {
            $this->setVerlag_ID(NULL);
        } else {
            $this->setVerlag_ID($v->getID());
        }

        $this->aVerlag = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Verlag object, it will not be re-added.
        if ($v !== null) {
            $v->addBuch($this);
        }


        return $this;
    }


    /**
     * Get the associated Verlag object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Verlag The associated Verlag object.
     * @throws PropelException
     */
    public function getVerlag(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aVerlag === null && ($this->verlag_id !== null) && $doQuery) {
            $this->aVerlag = VerlagQuery::create()->findPk($this->verlag_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVerlag->addBuchs($this);
             */
        }

        return $this->aVerlag;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->isbn = null;
        $this->titel = null;
        $this->autor_id = null;
        $this->verlag_id = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->aAutor instanceof Persistent) {
              $this->aAutor->clearAllReferences($deep);
            }
            if ($this->aVerlag instanceof Persistent) {
              $this->aVerlag->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aAutor = null;
        $this->aVerlag = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BuchPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
