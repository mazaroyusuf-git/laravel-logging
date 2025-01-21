<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    /**
     * A basic feature test example.
     * kita bisa menkonfigurasi jenis logging di config/logging.php lihat chapter 73
     * 
     * @return void
     */

    //unutk menggunkana log di laravel kita cukup menggunakan Log Facade di Illuminate/Support/Facades/Log
    public function testLog()
    {
        Log::info("hello info");
        Log::warning("Hello Warning");
        Log::error("Hello Error");
        Log::critical("Hello Critical");

        self::assertTrue(true);
    }

    //di monolog ada fitur context, di Log Facade ada juga parameter kedua yang bisa kita isi dengan context mirip seperti
    //di monolog
    public function testContext()
    {
        Log::info("Hello Context", ["user" => "yusuf"]);

        self::assertTrue(true);
    }

    //kadang kita ingin membuat banyak log dengan misalnya context yang sama, kita tidak perlu membuat context diseluruh
    //log tersebut kita bisa gunakan method withContext() dan otomatis semua log yang dihasilkan akan memakai data di
    //withContext
    public function testWithContext()
    {
        Log::withContext(["user" => "yusuf"]);

        Log::alert("Hello Alert");
        Log::warning("Hello Warning");

        self::assertTrue(true);
    }

    //kita bisa membuat Logger dengan jenis channel yang sudah kita pilih kita bisa gunakan method channel(string atau nama channel)
    //dan balikan nya adalah sebuah Logger yang bisa kita gunakan untuk mengirim log
    public function testWithChannel()
    {
        $slackLogger = Log::channel("slack");
        $slackLogger->error("Hello Slack");

        Log::info("Hello Info"); //yg ini akan mengirim ke default channel

        self::assertTrue(true);
    }

    //lihat chapter 78
    public function testFileHandler()
    {
        $fileLogger = Log::channel("file");
        $fileLogger->info("Hello World");
        $fileLogger->warning("Hello World");
        $fileLogger->error("Hello World");

        self::assertTrue(true);
    }
}
