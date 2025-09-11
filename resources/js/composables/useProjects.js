import { ref } from 'vue';
import axios from 'axios';

export default function useProjects() {
    const projects = ref([]);
    const project = ref(null);
    const error = ref(null);
    const loading = ref(false);

    const getProjects = async () => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.get('/api/projects');
            projects.value = response.data.ResponseMessage;
        } catch (err) {
            error.value = 'Could not fetch projects.';
        } finally {
            loading.value = false;
        }
    };

    const getProject = async (id) => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.get(`/api/projects/${id}`);
            project.value = response.data.ResponseMessage;
        } catch (err) {
            error.value = 'Could not fetch project.';
        } finally {
            loading.value = false;
        }
    };

    const createProject = async (projectData) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.post('/api/projects', projectData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        } catch (err) {
            if (err.response && err.response.data && err.response.data.errors) {
                const validationErrors = err.response.data.errors;
                const errorMessages = Object.values(validationErrors).flat();
                error.value = errorMessages.join(' ');
            } else {
                error.value = 'Failed to create project. You might not have permission.';
            }
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const updateProject = async (project, id) => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.post(`/api/projects/${id}`, project, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            console.log(response.data);
        } catch (err) {
            error.value = 'Failed to update project. You might not have permission.';
            throw err;
        }
    };

    const deleteProject = async (id) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.delete(`/api/projects/${id}`);
            projects.value = projects.value.filter(p => p.id !== id);
        } catch (err) {
            error.value = 'Failed to delete project. You might not have permission.';
            throw err;
        }
    };

    return {
        projects,
        project,
        error,
        loading,
        getProjects,
        getProject,
        createProject,
        updateProject,
        deleteProject
    };
}
