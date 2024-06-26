import csv
import random
import uuid
from faker import Faker

fake = Faker()

zones_states_cities = {
    'east': {
        'West Bengal': ['Kolkata', 'Siliguri', 'Durgapur'],
        'Odisha': ['Bhubaneswar', 'Cuttack', 'Rourkela'],
        'Assam': ['Guwahati', 'Dibrugarh', 'Silchar']
    },
    'west': {
        'Maharashtra': ['Mumbai', 'Pune', 'Nagpur'],
        'Gujarat': ['Ahmedabad', 'Surat', 'Vadodara'],
        'Rajasthan': ['Jaipur', 'Udaipur', 'Jodhpur']
    },
    'north': {
        'Delhi': ['New Delhi'],
        'Punjab': ['Amritsar', 'Ludhiana', 'Chandigarh'],
        'Uttar Pradesh': ['Lucknow', 'Kanpur', 'Varanasi']
    },
    'south': {
        'Karnataka': ['Bangalore', 'Mysore', 'Mangalore'],
        'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai'],
        'Kerala': ['Thiruvananthapuram', 'Kochi', 'Kozhikode']
    }
}

def generate_user_data(num_users):
    users = []
    for _ in range(num_users):
        name = fake.name()
        email = fake.email()
        password = fake.password()
        status = 'active'
        zone = random.choice(list(zones_states_cities.keys()))
        state = random.choice(list(zones_states_cities[zone].keys()))
        city = random.choice(zones_states_cities[zone][state])
        user = {
            'id': str(uuid.uuid4()),
            'name': name,
            'email': email,
            'email_verified_at': fake.date_time_this_decade(),
            'password': password,
            'remember_token': fake.md5(),
            'created_at': fake.date_time_this_decade(),
            'updated_at': fake.date_time_this_decade(),
            'location': fake.address(),
            'image': fake.image_url(),
            'deleted_at': '',
            'status': status,
            'zone': zone,
            'state': state,
            'city': city
        }
        users.append(user)
    return users

def write_csv(filename, users):
    keys = users[0].keys()
    with open(filename, 'w', newline='') as output_file:
        dict_writer = csv.DictWriter(output_file, fieldnames=keys)
        dict_writer.writeheader()
        dict_writer.writerows(users)

num_users = 100  # Change this number to generate more or fewer users
users = generate_user_data(num_users)
write_csv('users.csv', users)
