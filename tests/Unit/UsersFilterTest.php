<?php

namespace Tests\Unit;

use App\Filters\UserFilters;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersFilterTest extends TestCase
{
    /**
     * @var UserFilters
     */
    protected $usersFilter;


    public function setUp(): void
    {
        parent::setUp();
        $this->usersFilter = new UserFilters();
    }

    /**
     * test filter by currency.
     * @return void
     */
    public function testFilterUserByCurrency()
    {
        $expected = $this->usersFilter->filterByCurrency("AED","AED");
        $this->assertTrue($expected);
    }

    /**
     * test filter by currency.
     * @test
     * @return void
     */
    public function FilterUserByCurrencyFalse()
    {
        $expected = $this->usersFilter->filterByCurrency("AED","USD");
        $this->assertFalse($expected);
    }


    /**
     * test filter by status.
     * @return void
     */
    public function TestFilterUserByStatus()
    {
        $expected = $this->usersFilter->filterByCurrency("authorized","authorized");
        $this->assertTrue($expected);
    }

    /**
     * test filter by status.
     * @test
     * @return void
     */
    public function TestFilterUserByStatusFalse()
    {
        $expected = $this->usersFilter->filterByStatus("authorized","decline");
        $this->assertFalse($expected);
    }

    /**
     * test filter by status.
     * @return void
     */
    public function TestFilterUserByBalance()
    {
        $expected = $this->usersFilter->filterByBalance("100","400",'280');
        $this->assertTrue($expected);
    }

    /**
     * test filter by status.
     * @test
     * @return void
     */
    public function TestFilterUserByBalanceFalse()
    {
        $expected = $this->usersFilter->filterByBalance("100","280",'320');
        $this->assertFalse($expected);
    }

    /**
     * @test
     * @return void
     */
    public function Filter()
    {
        $users = [
            [
                "balance"=> 280,
                "currency"=> "EUR",
                "email"=> "parent1@parent.eu",
                "status"=> "authorised",
                "created_at"=> "2018-11-30",
                "id"=> "d3d29d70-1d25-11e3-8591-034165a3a613"
            ],
            [
                "balance"=> 280,
                "currency"=> "AED",
                "email"=> "parent1@parent.eu",
                "status"=> "declined",
                "created_at"=> "2018-11-30",
                "id"=> "d3d29d70-1d25-11e3-8591-034165a3a613"
            ],
            [
                "balance"=> 280,
                "currency"=> "AED",
                "email"=> "parent1@parent.eu",
                "status"=> "authorised",
                "created_at"=> "2018-11-30",
                "id"=> "d3d29d70-1d25-11e3-8591-034165a3a613"
            ],

        ];

        $actual = $this->usersFilter->filter($users,['currency'=>'AED','status'=>'authorised','balance'=>'280']);

        $expected = [
            [
                "balance"=> 280,
                "currency"=> "AED",
                "email"=> "parent1@parent.eu",
                "status"=> "authorised",
                "created_at"=> "2018-11-30",
                "id"=> "d3d29d70-1d25-11e3-8591-034165a3a613"
            ]
        ];

        $this->assertEquals($expected,$actual);
    }

}
