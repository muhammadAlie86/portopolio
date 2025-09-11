import { ref, reactive } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default function useAuth() {
    const router = useRouter();

    // State (data reaktif yang akan dibagi)
    const user = ref(JSON.parse(localStorage.getItem('user')));
    const token = ref(null);
    const error = ref(null);

    /**
     * Fungsi untuk menangani login
     * @param {object} credentials - {email, password}
     */
    const login = async (credentials) => {
        error.value = null; // Reset error
        try {
            const response = await axios.post('/api/login', credentials);
            const responseData = response.data.ResponseMessage;

            // Simpan token dan user
            localStorage.setItem('authToken', responseData.access_token);
            localStorage.setItem('user', JSON.stringify(responseData.user));

            // Update state reaktif
            token.value = responseData.access_token;
            user.value = responseData.user;

            // Atur header default axios untuk request selanjutnya
            axios.defaults.headers.common['Authorization'] = `Bearer ${responseData.access_token}`;

            // Redirect ke dashboard
            await router.push({ name: 'AdminDashboard' });

        } catch (err) {
            if (err.response && err.response.data && err.response.data.message) {
                error.value = err.response.data.message;
            } else {
                error.value = 'An unexpected error occurred.';
            }
        }
    };

    /**
     * Fungsi untuk logout
     */
    const logout = () => {
        localStorage.removeItem('authToken');
        localStorage.removeItem('user');
        token.value = null;
        user.value = null;
        delete axios.defaults.headers.common['Authorization'];
        router.push({ name: 'Login' }); // Asumsi nama route login adalah 'Login'
    };

    // Paparkan (expose) state dan method agar bisa digunakan oleh komponen
    return {
        user,
        token,
        error,
        login,
        logout
    };
}
