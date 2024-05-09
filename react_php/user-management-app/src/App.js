import logo from './logo.svg';
import './App.css';
import AddUser from './pages/AddUser';
import UsersList from './pages/UsersList';
import { Card, Container } from '@mui/material';
import Divider from '@mui/material/Divider';
import Typography from '@mui/material/Typography';


function App() {
  return (
    <div className="App">
      <Container>
        <Card>
          <Typography variant="h6" component="h2">
            Add New User
          </Typography>
          <AddUser />
        </Card>
        <Divider />
        <Card>
          <Typography variant="h6" component="h2">
            List of all Users
          </Typography>
          <UsersList />
        </Card>
      </Container>

    </div >
  );
}

export default App;
