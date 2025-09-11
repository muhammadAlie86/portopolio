import { ref } from 'vue';
import axios from 'axios';

export default function useArticles() {
    const articles = ref([]);
    const article = ref(null);
    const error = ref(null);
    const loading = ref(false);

    const getArticles = async () => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.get('/api/articles');
            articles.value = response.data.ResponseMessage;
        } catch (err) {
            error.value = 'Could not fetch articles.';
        } finally {
            loading.value = false;
        }
    };

    const getArticle = async (id) => {
        loading.value = true;
        error.value = null;
        try {
            const response = await axios.get(`/api/articles/${id}`);
            article.value = response.data.ResponseMessage;
        } catch (err) {
            error.value = 'Could not fetch article.';
        } finally {
            loading.value = false;
        }
    };

    const createArticle = async (articleData) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.post('/api/articles', articleData, {
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
                error.value = 'Failed to create article. You might not have permission.';
            }
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const updateArticle = async (id, articleData) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.post(`/api/articles/${id}`, articleData, {
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
                error.value = 'Failed to update article. You might not have permission.';
            }
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const deleteArticle = async (id) => {
        loading.value = true;
        error.value = null;
        try {
            await axios.delete(`/api/articles/${id}`);
        } catch (err) {
            error.value = 'Failed to delete article. You might not have permission.';
            throw err;
        } finally {
            loading.value = false;
        }
    };

    return {
        articles,
        article,
        error,
        loading,
        getArticles,
        getArticle,
        createArticle,
        updateArticle,
        deleteArticle
    };
}
