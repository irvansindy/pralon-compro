<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
class TestSecurity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-security';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run security tests (XSS, User-Agent, Content-Type, Header Injection, Rate Limit)';

    /**
     * Base URL for testing
     */
    protected $baseUrl = 'http://127.0.0.1:8000';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚨 Starting Security Tests...');

        $this->testXSS();
        $this->testBlockedUserAgent();
        $this->testBlockedContentType();
        $this->testHeaderInjection();
        $this->testRateLimit();

        $this->info('✅ All security tests executed. Check blocked_requests & notifications!');
    }
    private function testXSS()
    {
        $this->line('🔎 Testing XSS Injection...');
        $response = Http::get($this->baseUrl . '/test-security', [
            'name' => '<script>alert(1)</script>'
        ]);
        $this->showResponse($response);
    }

    private function testBlockedUserAgent()
    {
        $this->line('🔎 Testing Blocked User-Agent...');
        $response = Http::withHeaders([
            'User-Agent' => 'sqlmap'
        ])->get($this->baseUrl . '/test-security');
        $this->showResponse($response);
    }

    private function testBlockedContentType()
    {
        $this->line('🔎 Testing Blocked Content-Type...');
        $response = Http::withHeaders([
            'Content-Type' => 'application/xml'
        ])->post($this->baseUrl . '/test-security', '<data>test</data>');
        $this->showResponse($response);
    }

    private function testHeaderInjection()
    {
        $this->line('🔎 Testing Header Injection...');
        $response = Http::withHeaders([
            "X-Test" => "malicious\r\nInjected-Header: value"
        ])->get($this->baseUrl . '/test-security');
        $this->showResponse($response);
    }

    private function testRateLimit()
    {
        $this->line('🔎 Testing Rate Limit...');
        for ($i = 1; $i <= 101; $i++) {
            $response = Http::get($this->baseUrl . '/test-security');
            if ($i === 101) {
                $this->warn("⚡ Rate Limit Triggered at Request #{$i}");
                $this->showResponse($response);
            }
        }
    }

    private function showResponse($response)
    {
        $status = $response->status();
        if ($status >= 400) {
            $this->error("❌ {$status} {$response->body()}");
        } else {
            $this->info("✅ {$status} " . json_encode($response->json()));
        }
    }
}
