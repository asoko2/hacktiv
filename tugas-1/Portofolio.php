<?php
class Portofolio
{
  public function __construct(
    public string $name,
    public string $role,
    public int $age,
    public string $availability,
    public string $location,
    public string $email,
    public int $experience,
  ) {
  }

}