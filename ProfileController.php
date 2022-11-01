<?php

class ProfileController
{
    #[Route(url: '/{id}')]
    public function __invoke(int $id, Request $request){
        return 'Profile ID:'.$id;
    }
}