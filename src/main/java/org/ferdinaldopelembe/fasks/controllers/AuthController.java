package org.ferdinaldopelembe.fasks.controllers;

import org.ferdinaldopelembe.fasks.dtos.SignInRequest;
import org.ferdinaldopelembe.fasks.dtos.SignInResponse;
import org.ferdinaldopelembe.fasks.dtos.SignUpRequest;
import org.ferdinaldopelembe.fasks.dtos.SignUpResponse;
import org.ferdinaldopelembe.fasks.services.user.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.HttpStatusCode;
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
        if (!userService.isValidEmail(signInRequest.getEmail())) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).build();
        }
        return userService.existsByEmail(signInRequest.getEmail()) ?
            userService.signInUser(signInRequest)
                .map(ResponseEntity::ok)
                .orElse(ResponseEntity.status(HttpStatus.NOT_ACCEPTABLE).build()) :
            ResponseEntity.notFound().build();
    }

    @PostMapping("/signup")
    public ResponseEntity<SignUpResponse> signUpUser(@RequestBody SignUpRequest signUpRequest) {
        if (!userService.isValidEmail(signUpRequest.getEmail())) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).build();
        }
        return userService.signUpUser(signUpRequest)
            .map(ResponseEntity::ok)
            .orElse(ResponseEntity.status(HttpStatus.CONFLICT).build());
    }

}
