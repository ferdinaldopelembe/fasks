package org.ferdinaldopelembe.fasks.repositories;

import java.util.List;
import java.util.Optional;

import org.ferdinaldopelembe.fasks.models.Task;
import org.springframework.data.jpa.repository.JpaRepository;

public interface TaskRepository extends JpaRepository<Task, Long> {
    Optional<List<Task>> findByUserId(Long userId);
}
