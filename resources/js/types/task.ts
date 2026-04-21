export type TaskStatus = 'pending' | 'completed';

export interface Task {
    id: number;
    title: string;
    description: string | null;
    status: TaskStatus;
    position: number;
    created_at: string;
    updated_at: string;
}
