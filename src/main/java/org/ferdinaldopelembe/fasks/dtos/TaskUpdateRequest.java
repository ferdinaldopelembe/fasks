package org.ferdinaldopelembe.fasks.dtos;

import java.time.LocalDateTime;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class TaskUpdateRequest {
    private Long id;
    private String title;
    private String description;
    private Long userId;
    private LocalDateTime createdAt;
    private Boolean completed;
}
