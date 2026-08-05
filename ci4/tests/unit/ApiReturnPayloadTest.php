<?php

namespace Tests\Unit;

use App\Controllers\Api;
use CodeIgniter\Test\CIUnitTestCase;

class ApiReturnPayloadTest extends CIUnitTestCase
{
    public function testNormalizeReturnPayloadUsesSalesorderMetadataWhenOrderNoIsMissing(): void
    {
        $api = new class extends Api {
            public function __construct() {}

            public function publicNormalizeReturnPayload(array $item): array
            {
                return $this->normalizeReturnPayload($item);
            }
        };

        $payload = [
            'action' => 'update-salesorder',
            'items' => [
                ['salesorder_detail_id' => 51978],
            ],
            'salesorder_id' => 477651,
            'salesorder_no' => 'SO-000477651',
            'process_number' => 'PN-000001143',
            'created_date' => '2026-04-13T07:05:44.632Z',
            'status' => 'RETURNED',
        ];

        $normalized = $api->publicNormalizeReturnPayload($payload);

        $this->assertSame('SO-000477651', $normalized['order_no']);
        $this->assertSame('PN-000001143', $normalized['return_no']);
        $this->assertNotEmpty($normalized['return_date']);
        $this->assertSame('pending', $normalized['status']);
    }
}
