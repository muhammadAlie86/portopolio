import { ref } from 'vue';
import axios from 'axios';

export default function useUsers() {
    const users = ref([]); // <-- Tambahkan state untuk daftar user
    const error = ref(null);
    const loading = ref(false);

    /**
     * Mengambil daftar user dari API
     */
    const getUsers = async () => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.get('/api/users');
            users.value = response.data.ResponseMessage;
        } catch (err) {
            error.value = 'Could not fetch users.';
        } finally {
            loading.value = false;
        }
    };

    /**
     * Menyimpan user baru via API
     * @param {object} userData - Data user dari form
     */
    const storeUser = async (userData) => {
        error.value = null;
        loading.value = true;
        try {
            await axios.post('/api/users', userData);
        } catch (err) {
            if (err.response && err.response.data && err.response.data.errors) {
                const validationErrors = err.response.data.errors;
                const errorMessages = Object.values(validationErrors).flat();
                error.value = errorMessages.join(' ');
            } else {
                error.value = 'Failed to create user. You might not have permission.';
            }
            throw err;
        } finally {
            loading.value = false;
        }
    };

    /**
     * Mengaktifkan atau menonaktifkan user.
     * @param {number} userId - ID user yang akan diubah statusnya.
     */
    const toggleUserActive = async (userId) => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.post(`/api/users/${userId}/toggle-active`);
            // Update user di daftar lokal jika berhasil
            const updatedUser = response.data.ResponseMessage;
            const index = users.value.findIndex(u => u.id === updatedUser.id);
            if (index !== -1) {
                users.value[index] = updatedUser;
            }
        } catch (err) {
            error.value = 'Failed to toggle user status. You might not have permission.';
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const updateUser = async (user) => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.put(`/api/users/${user.id}`, user);
            const updatedUser = response.data.ResponseMessage;
            const index = users.value.findIndex(u => u.id === updatedUser.id);
            if (index !== -1) {
                users.value[index] = updatedUser;
            }
        } catch (err) {
            error.value = 'Failed to update user. You might not have permission.';
            throw err;
        }
    };

    const destroyUser = async (id) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.delete(`/api/users/${id}`);
            users.value = users.value.filter(u => u.id !== id);
        } catch (err) {
            error.value = 'Failed to delete user. You might not have permission.';
            throw err;
        }
    };

    return {
        users,
        error,
        loading,
        getUsers,
        storeUser,
        toggleUserActive, // <-- Paparkan fungsi baru
        updateUser,
        destroyUser
    };
}
