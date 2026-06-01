package org.ferdinaldopelembe.fasks.controllers;

import java.util.List;

import org.ferdinaldopelembe.fasks.dtos.TaskRequest;
import org.ferdinaldopelembe.fasks.dtos.TaskResponse;
import org.ferdinaldopelembe.fasks.dtos.TaskUpdateRequest;
import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.services.task.TaskService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/tasks")
public class TaskController {

    @Autowired
    TaskService taskService;

    @GetMapping
    public ResponseEntity<List<TaskResponse>> getUserTasks(@AuthenticationPrincipal User user) {
        return taskService
                .getUserTasks(user)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.notFound().build());
    }

    @PostMapping
    public ResponseEntity<TaskResponse> createTask(
            @RequestBody TaskRequest taskRequest,
            @AuthenticationPrincipal User user) {
        return taskService
                .createTask(taskRequest, user)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.internalServerError().build());

    }

    @PutMapping
    public ResponseEntity<TaskResponse> updateTask(@RequestBody TaskUpdateRequest task,
            @AuthenticationPrincipal User user) {
        return taskService.updateTask(task).map(ResponseEntity::ok).orElse(ResponseEntity.notFound().build());
    }
}