<?php
namespace Aura\Sql;

/**
 * Test class for AbstractMapper.
 * Generated by PHPUnit on 2012-09-27 at 17:37:26.
 */
class AbstractMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractMapper
     */
    protected $mapper;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->mapper = new MockMapper;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    protected function newConnection()
    {
        $factory = new ConnectionFactory(['mock' => 'Aura\Sql\Connection\Mock']);
        return $factory->newInstance(
            'mock',
            ['host' => 'default.example.com', 'dbname' => 'test'],
            'default_user',
            'default_pass',
            []
        );
    }
    
    /**
     * @covers Aura\Sql\AbstractMapper::getCols
     * @todo Implement testGetCols().
     */
    public function testGetCols()
    {
        $expect = [
            'id',
            'name',
            'test_size_scale',
            'test_default_null',
            'test_default_string',
            'test_default_number',
            'test_default_ignore',
        ];
        $actual = $this->mapper->getCols();
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getColForField
     * @todo Implement testGetColForField().
     */
    public function testGetColForField()
    {
        $expect = 'id';
        $actual = $this->mapper->getColForField('identity');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getFields
     * @todo Implement testGetFields().
     */
    public function testGetFields()
    {
        $expect = [
            'identity',             
            'firstName',
            'sizeScale',
            'defaultNull',
            'defaultString',
            'defaultNumber',
            'defaultIgnore',
        ];
        $actual = $this->mapper->getFields();
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getFieldForCol
     * @todo Implement testGetFieldForCol().
     */
    public function testGetFieldForCol()
    {
        $expect = 'identity';
        $actual = $this->mapper->getFieldForCol('id');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getIdentityField
     * @todo Implement testGetIdentityField().
     */
    public function testGetIdentityField()
    {
        $expect = 'identity';
        $actual = $this->mapper->getIdentityField('id');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getIdentityValue
     * @todo Implement testGetIdentityValue().
     */
    public function testGetIdentityValue()
    {
        $object = (object) [
            'identity' => 88
        ];
        
        $expect = 88;
        $actual = $this->mapper->getIdentityValue($object);
        $this->assertSame($expect, $actual);
        
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getPrimaryCol
     * @todo Implement testGetPrimaryCol().
     */
    public function testGetPrimaryCol()
    {
        $expect = 'id';
        $actual = $this->mapper->getPrimaryCol('id');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getTable
     * @todo Implement testGetTable().
     */
    public function testGetTable()
    {
        $expect = 'fake_table';
        $actual = $this->mapper->getTable();
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getTableCol
     * @todo Implement testGetTableCol().
     */
    public function testGetTableCol()
    {
        $expect = 'fake_table.name';
        $actual = $this->mapper->getTableCol('name');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getTableColAsField
     * @todo Implement testGetTableColAsField().
     */
    public function testGetTableColAsField()
    {
        $expect = 'fake_table.name AS firstName';
        $actual = $this->mapper->getTableColAsField('name');
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getTablePrimaryCol
     * @todo Implement testGetTablePrimaryCol().
     */
    public function testGetTablePrimaryCol()
    {
        $expect = 'fake_table.id';
        $actual = $this->mapper->getTablePrimaryCol();
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getTableColsAsFields
     * @todo Implement testGetTableColsAsFields().
     */
    public function testGetTableColsAsFields()
    {
        $expect = [
        'fake_table.id AS identity',
        'fake_table.name AS firstName',
        'fake_table.test_size_scale AS sizeScale',
        'fake_table.test_default_null AS defaultNull',
        'fake_table.test_default_string AS defaultString',
        'fake_table.test_default_number AS defaultNumber',
        'fake_table.test_default_ignore AS defaultIgnore',
        ];
        
        $actual = $this->mapper->getTableColsAsFields([
            'id',
            'name',
            'test_size_scale',
            'test_default_null',
            'test_default_string',
            'test_default_number',
            'test_default_ignore',
        ]);
        
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::modifySelect
     * @todo Implement testModifySelect().
     */
    public function testModifySelect()
    {
        $connection = $this->newConnection();
        $select = $connection->newSelect();
        $this->mapper->modifySelect($select);
        $actual = $select->__toString();
        $expect = "
            SELECT
                fake_table.id AS identity,
                fake_table.name AS firstName,
                fake_table.test_size_scale AS sizeScale,
                fake_table.test_default_null AS defaultNull,
                fake_table.test_default_string AS defaultString,
                fake_table.test_default_number AS defaultNumber,
                fake_table.test_default_ignore AS defaultIgnore
            FROM
                fake_table
        ";
        
        $this->assertSameSql($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::modifyInsert
     * @todo Implement testModifyInsert().
     */
    public function testModifyInsert()
    {
        $object = (object) [
            'identity' => null,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $connection = $this->newConnection();
        $insert = $connection->newInsert();
        $this->mapper->modifyInsert($insert, $object);
        
        $actual = $insert->__toString();
        $expect = "
            INSERT INTO fake_table (
                id,
                name,
                test_size_scale,
                test_default_null,
                test_default_string,
                test_default_number,
                test_default_ignore
            ) VALUES (
                :id,
                :name,
                :test_size_scale,
                :test_default_null,
                :test_default_string,
                :test_default_number,
                :test_default_ignore
            )
        ";
        $this->assertSameSql($expect, $actual);
        
        $actual = $insert->getBind();
        $expect = [
            'id' => null,
            'name' => 'Laura',
            'test_size_scale' => 10,
            'test_default_null' => null,
            'test_default_string' => null,
            'test_default_number' => null,
            'test_default_ignore' => null,
        ];
        $this->assertSame($expect, $actual);
    }

    /**
     * @todo Implement testModifyUpdate().
     */
    public function testModifyUpdate()
    {
        $object = (object) [
            'identity' => 88,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $connection = $this->newConnection();
        $update = $connection->newUpdate();
        $this->mapper->modifyUpdate($update, $object);
        
        $actual = $update->__toString();
        $expect = "
            UPDATE fake_table
            SET
                id = :id,
                name = :name,
                test_size_scale = :test_size_scale,
                test_default_null = :test_default_null,
                test_default_string = :test_default_string,
                test_default_number = :test_default_number,
                test_default_ignore = :test_default_ignore
            WHERE
                id = 88
        ";
        $this->assertSameSql($expect, $actual);
        
        $actual = $update->getBind();
        $expect = [
            'id' => 88,
            'name' => 'Laura',
            'test_size_scale' => 10,
            'test_default_null' => null,
            'test_default_string' => null,
            'test_default_number' => null,
            'test_default_ignore' => null,
        ];
        $this->assertSame($expect, $actual);
    }

    /**
     * @todo Implement testModifyUpdate().
     */
    public function testModifyUpdateChanges()
    {
        $new_object = (object) [
            'identity' => 88,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $old_object = (object) [
            'identity' => 88,
            'firstName' => 'Lora',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $connection = $this->newConnection();
        $update = $connection->newUpdate();
        $this->mapper->modifyUpdate($update, $new_object, $old_object);
        
        $actual = $update->__toString();
        $expect = "
            UPDATE fake_table
            SET
                name = :name
            WHERE
                id = 88
        ";
        $this->assertSameSql($expect, $actual);
        
        $actual = $update->getBind();
        $expect = [
            'name' => 'Laura',
        ];
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::modifyDelete
     * @todo Implement testModifyDelete().
     */
    public function testModifyDelete()
    {
        $object = (object) [
            'identity' => 88,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $connection = $this->newConnection();
        $delete = $connection->newDelete();
        $this->mapper->modifyDelete($delete, $object);
        
        $actual = $delete->__toString();
        $expect = "
            DELETE FROM fake_table
            WHERE
                id = 88
        ";
        $this->assertSameSql($expect, $actual);
        
        $actual = $delete->getBind();
        $expect = [];
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::getInsertData
     * @todo Implement testGetInsertData().
     */
    public function testGetInsertData()
    {
        $object = (object) [
            'identity' => null,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $expect = [
            'id' => null,
            'name' => 'Laura',
            'test_size_scale' => 10,
            'test_default_null' => null,
            'test_default_string' => null,
            'test_default_number' => null,
            'test_default_ignore' => null,
        ];
        
        $actual = $this->mapper->getInsertData($object);
        $this->assertSame($expect, $actual);
    }

    /**
     * @todo Implement testGetUpdateData().
     */
    public function testGetUpdateData()
    {
        $object = (object) [
            'identity' => 88,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $expect = [
            'id' => 88,
            'name' => 'Laura',
            'test_size_scale' => 10,
            'test_default_null' => null,
            'test_default_string' => null,
            'test_default_number' => null,
            'test_default_ignore' => null,
        ];
        
        $actual = $this->mapper->getUpdateData($object);
        $this->assertSame($expect, $actual);
    }

    /**
     * @todo Implement testGetUpdateDataChanges().
     */
    public function testGetUpdateDataChanges()
    {
        $new_object = (object) [
            'identity' => 88,
            'firstName' => 'Laura',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $old_object = (object) [
            'identity' => 88,
            'firstName' => 'Lora',
            'sizeScale' => 10,
            'defaultNull' => null,
            'defaultString' => null,
            'defaultNumber' => null,
            'defaultIgnore' => null,
        ];
        
        $expect = [
            'name' => 'Laura',
        ];
        
        // uses getUpdateDataChanges()
        $actual = $this->mapper->getUpdateData($new_object, $old_object);
        $this->assertSame($expect, $actual);
    }

    /**
     * @covers Aura\Sql\AbstractMapper::compare
     * @todo Implement testCompare().
     */
    public function testCompare()
    {
        $new_numeric = 88;
        $old_numeric = "69";
        $compare = $this->mapper->compare($new_numeric, $old_numeric);
        $this->assertFalse($compare);
        
        $new_numeric = 88;
        $old_numeric = "88";
        $compare = $this->mapper->compare($new_numeric, $old_numeric);
        $this->assertTrue($compare);
        
        $new_string = "Foo";
        $old_string = "Bar";
        $compare = $this->mapper->compare($new_string, $old_string);
        $this->assertFalse($compare);
        
        $new_string = "Foo";
        $old_string = "Foo";
        $compare = $this->mapper->compare($new_string, $old_string);
        $this->assertTrue($compare);
    }

    protected function assertSameSql($expect, $actual)
    {
        $expect = trim($expect);
        $expect = preg_replace('/^\s*/m', '', $expect);
        $expect = preg_replace('/\s*$/m', '', $expect);
        
        $actual = trim($actual);
        $actual = preg_replace('/^\s*/m', '', $actual);
        $actual = preg_replace('/\s*$/m', '', $actual);
        
        $this->assertSame($expect, $actual);
    }
}
