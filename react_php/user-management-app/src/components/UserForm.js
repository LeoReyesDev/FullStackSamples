import React, { useState } from 'react';
import { TextField, Button, Box } from '@mui/material';
import axios from 'axios';

function UserForm({ onUserAdded }) {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [phone, setPhone] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        const API_URL = process.env.REACT_APP_API_BASE_URL + '/create.php';
        try {
            await axios.post(API_URL, { name, email, phone });
            onUserAdded(); // Notify parent to refresh the user list
            setName('');
            setEmail('');
            setPhone('');
        } catch (error) {
            console.error('Error adding user:', error);
        }
    };

    return (
        <Box component="form" noValidate autoComplete="off" onSubmit={handleSubmit}>
            <TextField label="Name" value={name} onChange={e => setName(e.target.value)} fullWidth margin="normal" />
            <TextField label="Email" value={email} onChange={e => setEmail(e.target.value)} fullWidth margin="normal" />
            <TextField label="Phone" value={phone} onChange={e => setPhone(e.target.value)} fullWidth margin="normal" />
            <Button type="submit" variant="contained" color="primary">Add User</Button>
        </Box>
    );
}

export default UserForm;
