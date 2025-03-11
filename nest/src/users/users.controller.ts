import { Controller, Get, Post, Put, Delete, Body, Param } from '@nestjs/common';
import { UsersService } from './users.service';
import { User } from '@prisma/client';

@Controller('users')
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  @Get()
  async allUsers(): Promise<User[]> {
    return this.usersService.allUsers();
  }

  @Get(':id')
  async userById(@Param('id') id: string): Promise<User> {
    return this.usersService.userById(Number(id));
  }

  @Post()
  async createUser(
    @Body() userData: { name: string; email: string; password: string },
  ): Promise<User> {
    return this.usersService.createUser(userData);
  }

  @Put(':id')
  async updateUser(
    @Param('id') id: string,
    @Body() userData: { name?: string; email?: string; password?: string },
  ): Promise<User> {
    return this.usersService.updateUser(Number(id), userData);
  }

  @Delete(':id')
  async deleteUser(@Param('id') id: string): Promise<User> {
    return this.usersService.deleteUser(Number(id));
  }
}
