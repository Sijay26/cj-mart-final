import mysql.connector
import sys

def setup_database():
    config = {
        'user': 'root',
        'password': '',
        'host': 'localhost',
        'raise_on_warnings': True
    }

    try:
        # Connect to MySQL server
        print("Connecting to MySQL server...")
        cnx = mysql.connector.connect(**config)
        cursor = cnx.cursor()

        # Read Schema
        print("Reading schema.sql...")
        with open('schema.sql', 'r') as f:
            schema = f.read()

        # Execute Schema
        # Split by ';' to get individual statements, but need to be careful with triggers/procedures if any.
        # Our schema is simple table creations and inserts.
        statements = schema.split(';')
        
        print("Executing SQL statements...")
        for statement in statements:
            if statement.strip():
                try:
                    cursor.execute(statement)
                except mysql.connector.Error as err:
                    # Ignore "database exists" or "table exists" if we want, or just print
                    print(f"Executed with message: {err.msg}")
                    # Usually "CREATE DATABASE IF NOT EXISTS" is fine.
                    
        print("Database 'cj_mart' initialized successfully!")
        
        cursor.close()
        cnx.close()

    except mysql.connector.Error as err:
        print(f"Error: {err}")
        sys.exit(1)
    except Exception as e:
        print(f"General Error: {e}")
        sys.exit(1)

if __name__ == "__main__":
    setup_database()
