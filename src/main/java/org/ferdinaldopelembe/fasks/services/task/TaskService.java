package org.ferdinaldopelembe.fasks.services.task;

import java.util.List;
import java.util.Optional;

import org.ferdinaldopelembe.fasks.dtos.TaskResponse;
import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.repositories.TaskRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Service;

@Service
public class TaskService {

    @Autowired
    TaskRepository taskRepository;
    
    public Optional<List<TaskResponse>> getUserTasks(@AuthenticationPrincipal User user) {
        return taskRepository
            .findByUserId(user.getId())
            .map(
                tasks -> tasks
                .stream()
                .map(task -> new TaskResponse(
                    task.getId(),
                    task.getTitle(),
                    task.getDescription(),
                    task.getUser().getId()
                ))
                .toList()
            );
    }
    
}
