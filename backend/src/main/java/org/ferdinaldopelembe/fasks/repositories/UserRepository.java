package org.ferdinaldopelembe.fasks.repositories;

import java.util.Optional;

import org.ferdinaldopelembe.fasks.models.User;
import org.springframework.data.jpa.repository.JpaRepository;

public interface UserRepository extends JpaRepository <User, Long> {
    Optional<User> findByEmail(String email);
    Optional<User> findByEmailAndPassword(String email, String password);
    Boolean existsByEmail (String email);
}
