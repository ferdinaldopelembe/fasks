package org.ferdinaldopelembe.fasks.services.user;

import java.util.List;
import java.util.Optional;

import org.ferdinaldopelembe.fasks.dtos.SignInRequest;
import org.ferdinaldopelembe.fasks.dtos.SignInResponse;
import org.ferdinaldopelembe.fasks.dtos.SignUpRequest;
import org.ferdinaldopelembe.fasks.dtos.SignUpResponse;
import org.ferdinaldopelembe.fasks.dtos.UserResponse;
import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.repositories.UserRepository;
import org.ferdinaldopelembe.fasks.security.jwt.JwtUtil;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Service;

@Service
public class UserService {

    @Autowired
    UserRepository userRepository;

    @Autowired
    JwtUtil jwtUtil;

    public Optional<List<User>> getAllUsers() {
        return Optional.of(userRepository.findAll());
    }

    public Boolean isValidEmail(String email) {
        return email.matches("^[a-z_][a-z\\._\\d]*@[a-z][a-z\\._\\d]*$");
    }

    public Boolean existsByEmail (String email) {
        return userRepository.existsByEmail(email);
    }

    public Optional<UserResponse> getCurrentUser(@AuthenticationPrincipal User user) {
        return Optional.of(
            new UserResponse(
                user.getId(),
                user.getEmail(),
                user.getName()
            )
        );
    }

    public Optional<SignInResponse> signInUser(SignInRequest signInRequest) {
        return userRepository
            .findByEmailAndPassword(
                signInRequest.getEmail(),
                signInRequest.getPassword()
            )
            .map(user -> new SignInResponse(
                user.getName(),
                jwtUtil.generateToken(user.getEmail())
            ));
    }

    public Optional<SignUpResponse> signUpUser(SignUpRequest signUpRequest) {
        User createdUser = new User(
            null,
            signUpRequest.getEmail(),
            signUpRequest.getName(),
            signUpRequest.getPassword()
        );

        if (userRepository.findByEmail(createdUser.getEmail()).isPresent()) {
            return Optional.empty();
        }

        userRepository.save(createdUser);

        return Optional.of(
            new SignUpResponse(
                createdUser.getName(),
                jwtUtil.generateToken(createdUser.getEmail())
            )
        );
    }
}
