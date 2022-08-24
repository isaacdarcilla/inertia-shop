<?php

test('can render store page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
