package org.ferdinaldopelembe.fasks.security.jwt;

import java.io.IOException;

import org.ferdinaldopelembe.fasks.models.User;
import org.ferdinaldopelembe.fasks.repositories.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.web.authentication.WebAuthenticationDetailsSource;
import org.springframework.stereotype.Component;
import org.springframework.web.filter.OncePerRequestFilter;

import jakarta.servlet.FilterChain;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

@Component
public class JwtFilter extends OncePerRequestFilter {

    @Autowired
    private JwtUtil jwtUtil;

    @Autowired
    private UserRepository userRepository;

    @SuppressWarnings("null")
    @Override
    protected void doFilterInternal(
        HttpServletRequest request,
        HttpServletResponse response,
        FilterChain filterChain
    ) throws ServletException, IOException {
        String authHeader = request.getHeader("Authorization");
       
        if (authHeader == null || !authHeader.startsWith("Bearer ")) {
            filterChain.doFilter(request, response);
            return;
        }

        String token = authHeader.replace("Bearer ", "");
        String email = null;

        try {
            email = jwtUtil.getEmailFromToken(token);
        } catch (Exception e) {
            System.out.println("Invalid token: " + e.getMessage());
            filterChain.doFilter(request, response);
            return;
        }

        System.out.println(token);
        System.out.println(email);

        //Continuar daqui!
        if (email != null && SecurityContextHolder.getContext().getAuthentication() == null) {
            User user = userRepository
                .findByEmail(email)
                .orElse(null);

            if (user != null && jwtUtil.isValidToken(token, user)) {
                UsernamePasswordAuthenticationToken authToken = 
                    new UsernamePasswordAuthenticationToken(
                        user,
                        null,
                        java.util.Collections.emptyList()
                    );
                authToken.setDetails(
                    new WebAuthenticationDetailsSource()
                    .buildDetails(request)
                );
                // Colocar autenticacao no spring security
                SecurityContextHolder
                    .getContext()
                    .setAuthentication(authToken);
            }   
        }
        filterChain.doFilter(request, response);
    }
}
