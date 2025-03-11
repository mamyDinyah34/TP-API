package com.mamydinyah.CRUP_API.repository;

import com.mamydinyah.CRUP_API.entity.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UserRepository extends JpaRepository<User, Long> {
}
