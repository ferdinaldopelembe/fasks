package org.ferdinaldopelembe.fasks.services.task;

import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

import org.ferdinaldopelembe.fasks.dtos.TaskRequest;
import org.ferdinaldopelembe.fasks.dtos.TaskResponse;
import org.ferdinaldopelembe.fasks.dtos.TaskUpdateRequest;
import org.ferdinaldopelembe.fasks.models.Task;
import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.repositories.TaskRepository;
import org.ferdinaldopelembe.fasks.repositories.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Service;

@Service
public class TaskService {

    @Autowired
    TaskRepository taskRepository;

    @Autowired
    UserRepository userRepository;

    public Optional<List<TaskResponse>> getUserTasks(@AuthenticationPrincipal User user) {
        return taskRepository
            .findByUserId(user.getId())
            .map(tasks -> tasks
                .stream()
                .map(task -> new TaskResponse(
                    task.getId(),
                    task.getTitle(),
                    task.getDescription(),
                    task.getUser().getId(),
                    task.getCreatedAt(),
                    task.getCompleted())
                )
                .toList()
            );
    }

    public Optional<TaskResponse> createTask(TaskRequest taskRequest, @AuthenticationPrincipal User user) {
        Task createdTask = new Task(
            null,
            user,
            taskRequest.getTitle(),
            taskRequest.getDescription(),
            false,
            LocalDateTime.now()
        );

        createdTask = taskRepository.save(createdTask);

        return Optional.of(
            new TaskResponse(
                createdTask.getId(),
                createdTask.getTitle(),
                createdTask.getDescription(),
                user.getId(),
                createdTask.getCreatedAt(),
                createdTask.getCompleted()
            )
        );
    }

    public Optional<TaskResponse> updateTask(TaskUpdateRequest task) {

        if (taskRepository.findById(task.getId()).isEmpty()) {
            return Optional.empty();
        }

        var userOptional = userRepository.findById(task.getUserId());
        if (userOptional.isEmpty()) {
            return Optional.empty();
        }

        taskRepository.save(new Task(
            task.getId(),
            userOptional.get(),
            task.getTitle(),
            task.getDescription(),
            task.getCompleted(),
            task.getCreatedAt()
        ));

        return Optional.of(
            new TaskResponse(
                task.getId(),
                task.getTitle(),
                task.getDescription(),
                task.getUserId(),
                task.getCreatedAt(),
                task.getCompleted()
            )
        );
    }

}
