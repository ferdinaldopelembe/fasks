package org.ferdinaldopelembe.fasks.controllers;

import org.ferdinaldopelembe.fasks.dtos.SignInRequest;
import org.ferdinaldopelembe.fasks.dtos.SignInResponse;
import org.ferdinaldopelembe.fasks.dtos.SignUpRequest;
import org.ferdinaldopelembe.fasks.dtos.SignUpResponse;
import org.ferdinaldopelembe.fasks.services.user.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/auth")
@CrossOrigin(origins = "*", allowedHeaders = "*")
public class AuthController {
    
    @Autowired
    UserService userService;

    @PostMapping("/signin")
    public ResponseEntity<SignInResponse> signInUser(@RequestBody SignInRequest signInRequest) {
        return userService.signInUser(signInRequest)
            .map(ResponseEntity::ok)
            .orElse(ResponseEntity.notFound().build());
    }

    @PostMapping("/signup")
    public ResponseEntity<SignUpResponse> signUpUser(@RequestBody SignUpRequest signUpRequest) {
        return userService.signUpUser(signUpRequest)
            .map(ResponseEntity::ok)
            .orElse(ResponseEntity.status(HttpStatus.CONFLICT).build());
    }

}
