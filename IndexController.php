<?php

class IndexController
{
    #[Route('/')]
    public function __invoke(Request $request){
        return 'Hallo Welt';
    }

    #[Route('/testYT')]
    public function testYT(Request $request){
        return 'Hallo Youtube';
    }
}