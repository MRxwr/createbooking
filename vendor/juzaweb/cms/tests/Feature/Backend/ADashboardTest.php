<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzawebcms/juzawebcms
 * @author     The Anh Dang <sbhadra0@gmail.com>
 * @link       https://github.com/juzawebcms/juzawebcms
 * @license    MIT
 */

namespace Juzaweb\Tests\Feature\Backend;

use Illuminate\Support\Facades\Auth;
use Juzaweb\Models\User;
use Juzaweb\Tests\TestCase;

class ADashboardTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('is_admin', '=', 1)
            ->first();
        Auth::loginUsingId($this->user->id);
    }

    public function testIndex()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }
}
