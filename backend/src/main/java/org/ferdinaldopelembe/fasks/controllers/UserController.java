package org.ferdinaldopelembe.fasks.controllers;

import java.util.List;

import org.ferdinaldopelembe.fasks.dtos.UserResponse;
import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.services.user.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/users")
@CrossOrigin(origins = "*", allowedHeaders = "*")
public class UserController {

    @Autowired
    UserService userService;

    @GetMapping
    public ResponseEntity<List<User>> getAllUsers() {
        return userService
            .getAllUsers()
            .map(ResponseEntity::ok)
            .orElse(ResponseEntity.notFound().build());
    }

    @GetMapping("/me")
    public ResponseEntity<UserResponse> getCurrentUser(@AuthenticationPrincipal User user) {
        return userService
            .getCurrentUser(user)
            .map(ResponseEntity::ok)
            .orElse(ResponseEntity.notFound().build());
    }
}
