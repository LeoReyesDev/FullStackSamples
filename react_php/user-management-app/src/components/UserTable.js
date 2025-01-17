import React, { useEffect, useState } from 'react';
import { Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper } from '@mui/material';
import axios from 'axios';

function UserTable() {
    const [users, setUsers] = useState([]);

    const fetchUsers = async () => {
        const API_URL = process.env.REACT_APP_API_BASE_URL + '/getAllUsers.php';
        try {
            const response = await axios.get(API_URL);
            setUsers(response.data.records);
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    };

    useEffect(() => {
        fetchUsers();
    }, []);

    console.log('ENDPOINT::::', process.env.REACT_APP_API_BASE_URL + '/getAllUsers.php')
    console.log('USERS:::', users)

    return (
        <TableContainer component={Paper}>
            <h6>Total Records {users.length}</h6>
            <Table>
                <TableHead>
                    <TableRow>
                        <TableCell>Name</TableCell>
                        <TableCell>Email</TableCell>
                        <TableCell>Phone</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {users.map(user => (
                        <TableRow key={user.id}>
                            <TableCell>{user.name}</TableCell>
                            <TableCell>{user.email}</TableCell>
                            <TableCell>{user.phone}</TableCell>
                        </TableRow>
                    ))}
                </TableBody>
            </Table>
        </TableContainer>
    );
}

export default UserTable;
